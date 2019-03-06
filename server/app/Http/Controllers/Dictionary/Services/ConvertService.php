<?php

namespace App\Http\Controllers\Dictionary\Services;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;
use App\Http\Controllers\Dictionary\Tables\PhrasesTable;
use RuntimeException;

class ConvertService extends BaseService
{
    const SHUFFLE_WORD = 'word';
    const SHUFFLE_LETTER = 'letter';
    const SHUFFLE_NONE = 'none';
    const SHUFFLE_RANDOM = 'random';

    /**
     * convert text to another language
     *
     * @param string $dictionaryName which dictionary to use
     * @param string $text the text to convert or blank to start with the table's "Start" text
     * @param string $shuffle SHUFFLE_... constants
     * @return string the translated string
     */
    public function convert(string $dictionaryName, string $text = null, string $shuffle = ConvertService::SHUFFLE_NONE)
    {
        $dictionary = $this->loadDictionary($dictionaryName);

        // use start text if none provided
        $phraseParts = $this->convertPhrase($dictionary, $text == null ? PhrasesTable::START : $text);

        return ucwords(preg_replace('/ +/', ' ', $this->randomizePhrase($phraseParts, $shuffle)));
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
            if ($to === PhrasesTable::VOWELS_REPLACEABLE) {
                $dictionary[$from] = $dictionary[PhrasesTable::VOWELS];
            } else if ($to === PhrasesTable::CONSONANTS_REPLACEABLE) {
                $dictionary[$from] = $dictionary[PhrasesTable::CONSONANTS];
            }
        }
        return $dictionary;
    }

    /**
     * @param array $dictionary
     * @param string $text
     * @return array
     */
    private function convertPhrase(array $dictionary, string $text)
    {
        // split by spaces

        // check if words match dictionary
            // yes, stub in translation
                // recurse
            // no, split word to letters
                // convert letters


        // split by spaces and convert each chunk either by direct match or by splitting to letters and finding matches
        return implode(' ', array_map(function ($part) use ($dictionary) {
            if (is_array($part)) {
                var_dump($part);
                throw new RuntimeException('Array for conversion must be a string');
            }
            $newPhrase = strtolower($part);

            if ($converted = isset($dictionary[$newPhrase])) {
                $newPhrase = $this->services->table->getTableResultRangeCustom('Translate word', $dictionary[$newPhrase]);
            }

            // if there are spaces, split to words and convert
            if (false !== strpos($newPhrase, ' ')) {
                $newPhrase = $this->convertPhrase($dictionary, $newPhrase);

            // check for percent inclusions criteria
            } else if (1 === preg_match('/^\%(\d+)(.*)$/', $newPhrase, $matches)) {
                if ($this->services->random->percentile('Translate Percent') <= intval($matches[1])) {
                    $newPhrase = $this->convertPhrase($dictionary, $matches[2]);
                } else {
                    $newPhrase = '';
                }

            // do letter by letter conversion of word; don't do single letters that have changed since they could infinite loop
            } else if (!$converted) {
                $newPhrase = implode('', array_map(function ($letter) use ($dictionary) {
                    return $this->convertPhrase($dictionary, $letter);
                }, str_split($newPhrase)));
            }

            return $newPhrase;
        }, explode(' ', $text)));
    }

    /**
     * @param string $phrase array of strings of words of phrase
     * @param string $shuffle SHUFFLE_... constants
     * @return string
     */
    private function randomizePhrase(string $phrase, string $shuffle)
    {
        if ($shuffle === ConvertService::SHUFFLE_RANDOM) {
            switch ($this->services->random->randRangeInt('Random Shuffle', 1, 3)) {
                case 1:
                    $shuffle = ConvertService::SHUFFLE_NONE;
                    break;
                case 2:
                    $shuffle = ConvertService::SHUFFLE_WORD;
                    break;
                case 3:
                    $shuffle = ConvertService::SHUFFLE_LETTER;
                    break;
                default:
                    throw new RuntimeException('Unknown random shuffle result');
            }
        }

        switch ($shuffle) {
            case ConvertService::SHUFFLE_LETTER:
                $letters = str_split($phrase);
                shuffle($letters);
                // remove double spaces possibly caused by shuffling
                $phrase = preg_replace('/ +/', ' ', implode('', $letters));
                break;

            case ConvertService::SHUFFLE_WORD:
                $phrases = explode(' ' , $phrase);
                shuffle($phrases);
                $phrase = implode(' ', $phrases);
                break;

            case ConvertService::SHUFFLE_NONE:
                break;

            default:
                throw new RuntimeException("Invalid shuffle type: $shuffle");
        }

        return $phrase;
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
