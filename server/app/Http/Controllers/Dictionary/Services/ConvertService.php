<?php

namespace App\Http\Controllers\Dictionary\Services;

use App\Http\Common\Services\BaseService;
use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;
use App\Http\Controllers\Dictionary\Models\DictionaryWord;
use App\Http\Controllers\Dictionary\Tables\PhrasesTable;
use RuntimeException;

class ConvertService extends BaseService
{
    const SHUFFLE_WORD = 'word';
    const SHUFFLE_LETTER = 'letter';
    const SHUFFLE_NONE = 'none';
    const SHUFFLE_RANDOM = 'random';

    /** @var array the dictionaries as they are looked up as needed */
    private $dictionaries = [];

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
        // use start text if none provided
        $phraseParts = $this->convertPhrase($dictionaryName, $text, true);

        $result = $this->randomizePhrase($phraseParts, $shuffle);

        // should prevent "Malformed UTF-8 characters, possibly incorrectly encoded<" errors
        $result = mb_convert_encoding($result, 'UTF-8', 'UTF-8');

        return ucwords(preg_replace('/ +/', ' ', $result));
    }

    /**
     * @param string $dictionaryName
     * @return array dictionary table
     */
    private function loadDictionary(string $dictionaryName)
    {
        if (!isset($this->dictionaries[$dictionaryName])) {
            $this->dictionaries[$dictionaryName] = DictionaryTable::getTable($dictionaryName)->getTable();
        }
        return $this->dictionaries[$dictionaryName];
    }

    /**
     * @param string $dictionaryName name of the dictionary
     * @param string|null $text
     * @param bool $allConvertible
     * @return string
     */
    private function convertPhrase(string $dictionaryName, ?string $text, bool $allConvertible)
    {
        $words = $this->phraseToDictionaryWords($text ? $text : PhrasesTable::START, true, $dictionaryName, $allConvertible);

        $words = array_map([$this, 'convertDictionaryWord'], $words);

        $words = array_filter($words, function ($word) {
            return $word->word && !$word->skip;
        });

        $words = array_map(function ($word) {
            return $word->word;
        }, $words);

        return join(' ', $words);
    }

    /**
     * @param string $phrase
     * @param bool $splitBySpace true = ' ' word splitting, false = '' letter splitting
     * @param string $dictionaryName
     * @param bool $allConvertible
     * @return array
     */
    private function phraseToDictionaryWords(string $phrase, bool $splitBySpace, string $dictionaryName, bool $allConvertible)
    {
        if ($splitBySpace) {
            $words = explode(' ', $phrase);
        } else {
            $words = $this->services->utf8Service->explode($phrase);
        }

        return array_map(
            [$this, 'wordToDictionaryWord'],
            $words,
            array_fill(0, count($words), $dictionaryName),
            array_fill(0, count($words), $allConvertible)
        );
    }

    /**
     * convert a DictionaryWord object to a translated word
     *
     * @param DictionaryWord $word
     * @return DictionaryWord resulting translated word
     */
    private function convertDictionaryWord(DictionaryWord $word)
    {
        if (!$word->skip && $word->convertible) {
            // see if dictionary has a conversion for the word
            $dictionary = $this->loadDictionary($word->dictionary);

            // has translation, then update word with converted word... recurse if has a * in it... so convert result to words with default of convertible to false
            if (isset($dictionary[$word->word])) {
                $possibles = $dictionary[$word->word];
                $possibles = is_array($possibles) ? $possibles : [$possibles];

                if (count($possibles) === 1) {
                    $word->word = $possibles[0];
                } else {
                    $word->word = $this->services->table->getTableResultRangeCustom('Translate word', $possibles);
                }

                // convert table result to DictionaryWord but make it inconvertible by default unless it starts with a BaseTable::SPECIFIER_CONVERTIBLE
                $word->word = $this->convertPhrase($word->dictionary, $word->word, false);

            // no translation, break word in to letters and try to convert each letter; don't break letter to letter
            } else if (mb_strlen($word->word) > 1) {
                $words = $this->phraseToDictionaryWords($word->word, false, $word->dictionary, true);
                $words = array_map([$this, 'convertDictionaryWord'], $words);
                $words =  array_map(function ($letter) {
                    return $letter->word;
                }, $words);

                $word->word = join('', $words);
                $word->convertible = false;
            }
        }

        return $word;
    }

    /**
     * @param string $word
     * @param string $dictionaryName
     * @param bool $allConvertible
     * @return DictionaryWord
     */
    private function wordToDictionaryWord(string $word, string $dictionaryName, bool $allConvertible)
    {
        $matches = [];
        preg_match('/^(\!)?(\*)?(\%\d+)?(:.+:)?(.*)$/', $word, $matches);
        return array_reduce(array_filter(array_slice($matches, 1), function ($match) {
            // filter out blanks
            return $match;

        }), function ($dictionaryWord, $match) {
            switch ($match[0]) {
                case BaseTable::SPECIFIER_CONVERTIBLE:
                    $dictionaryWord->convertible = true;
                    break;

                case BaseTable::SPECIFIER_INCONVERTIBLE:
                    $dictionaryWord->convertible = false;
                    break;

                case BaseTable::SPECIFIER_DICTIONARY_NAME:
                    $dictionaryWord->dictionary = substr($match, 1, -1);
                    break;

                case BaseTable::SPECIFIER_OPTIONAL_PERCENT:
                    $dictionaryWord->skip = $this->services->random->percentile('Include Word') > intval(substr($match, 1));
                    break;

                default:
                    $dictionaryWord->word = $match;
                    break;
            }
            return $dictionaryWord;
        }, new DictionaryWord(BaseTable::START, $dictionaryName, $allConvertible));
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
                $letters = $this->services->utf8Service->explode($phrase);
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
