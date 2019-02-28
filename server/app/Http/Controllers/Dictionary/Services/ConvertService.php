<?php

namespace App\Http\Controllers\Dictionary\Services;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;
use App\Http\Controllers\Dictionary\Tables\PhrasesTable;

class ConvertService extends BaseService
{

    /**
     * convert text to another language
     *
     * @param string $dictionaryName which dictionary to use
     * @param string $text the text to convert
     * @param bool $shuffle can the words be shuffled
     * @return string the translated string
     */
    public function convert(string $dictionaryName, string $text, bool $shuffle)
    {
        $dictionary = $this->loadDictionary($dictionaryName);

        $phraseParts = $this->convertPhrase($dictionary, $text, $shuffle);

        if ($shuffle) {
            shuffle($phraseParts);
        }

        return ucwords(implode(' ', $phraseParts));
    }

    /**
     * @param string $dictionaryTable
     * @return array
     */
    private function loadDictionary(string $dictionaryTable)
    {
        $dictionary = DictionaryTable::getTable($dictionaryTable)->getTable();

        // set up the table so that anything that is a * item goes to the results directly instead of having to lookup and can remove the *
        foreach ($dictionary as $from => $to) {
            if ($to === PhrasesTable::VOWELS_WILD) {
                $dictionary[$from] = $dictionary[PhrasesTable::VOWELS];
            } else if ($to === PhrasesTable::CONSONANTS_WILD) {
                $dictionary[$from] = $dictionary[PhrasesTable::CONSONANTS];
            }
        }
        return $dictionary;
    }

    /**
     * @param array $dictionary
     * @param string $text
     * @param bool $shuffle
     * @return array
     */
    private function convertPhrase(array $dictionary, string $text, bool $shuffle)
    {
        // split by spaces and convert each chunk either by direct match or by splitting to letters and finding matches
        $that = $this;
        return array_map(function ($part) use ($dictionary, $shuffle, $that) {
            $lowerPart = strtolower($part);
            if (isset($dictionary[$lowerPart])) {
                $translated = $that->services->table->getTableResultRangeCustom('Translate word', $dictionary[$lowerPart]);
            } else if (mb_strlen($part, 'utf-8') > 1) {
                $letters = array_filter(str_split($lowerPart), function ($word) {
                    return $word;
                });
                if ($shuffle) {
                    shuffle($letters);
                }
                $translated = implode(array_map(function ($letter) use ($dictionary, $that) {
                    if (isset($dictionary[$letter])) {
                        $translated = $that->services->table->getTableResultRangeCustom('Translate letter', $dictionary[$letter]);
                    } else {
                        $translated = $letter;
                    }
                    return $translated;
                }, $letters));
            } else {
                $translated = $part;
            }
            return $translated;
        }, explode(' ', $text));
    }
}

/**
 * https://www.texelate.co.uk/blog/multibyte-safe-str-split-with-php
 * è was not splitting to one character
 *
 * @param $str
 * @return array
 */
function str_split_utf8($str)
{

    $arr = [];
    $length = mb_strlen($str, 'UTF-8');
    for ($i = 0; $i < $length; $i++) {
        $arr[] = mb_substr($str, $i, 1, 'UTF-8');
    }
    return $arr;
}
