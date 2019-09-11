<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\Race;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;
use App\Http\Controllers\Dictionary\Services\ConvertService;

class RandomNameService extends BaseService
{
    /**
     * @param City $city
     * @param PostData $postData
     */
    public function generateName(City $city, PostData $postData)
    {
        if ($postData->name === RandomService::RANDOM) {
            $city->name = $this->generateRandomName($city);
        } else {
            $city->name = $postData->name;
        }
    }

    /**
     * @param City $city
     * @return string
     */
    private function generateRandomName(City $city)
    {
        $dictionary = $this->getDictionaryRaceName($city->majorityRace);

        // $dictionary can be blank for human and halfling types
        if (!$dictionary && $this->services->random->percentile('Use words') > 50) {
            $name = $this->useNameWords();

        } else {
            $name = $this->useNameSyllables();

            if ($dictionary) {
                $name = $this->services->dictionaryConvert->convert($dictionary, $name, ConvertService::SHUFFLE_RANDOM);
            }
        }

        return ucwords(strtolower($name));
    }

    /**
     * determine dictionary name to use on dictionary site for converting name
     *
     * @param $majorityRace
     * @return string|null
     */
    private function getDictionaryRaceName($majorityRace)
    {
        $dictionary = null;

        // do conversion to other languages using dictionary
        switch ($majorityRace) {
            case Race::ELF:
                $dictionary = DictionaryTable::PHRASES_ELF;
                break;

            case Race::GNOME:
            case Race::DWARF:
                $dictionary = DictionaryTable::PHRASES_GOBLIN;
                break;

            case Race::HALFELF:
                // split 50/50 human or elf
                if ($this->services->random->percentile('Name: half elf') > 50) {
                    $dictionary = DictionaryTable::PHRASES_ELF;
                }
                break;

            case Race::HALFORC:
                // split 50/50 orc or elf
                if ($this->services->random->percentile('Name: half orc') > 50) {
                    $dictionary = DictionaryTable::PHRASES_TOLKIEN_BLACK_SPEECH;
                }
                break;

            case Race::HALFLING:
            case Race::HUMAN:
            case Race::OTHER:
                break;

            default:
                exit('Oops, bad majority race: ' . $majorityRace);
        }

        return $dictionary;
    }

    /**
     * @return string name
     */
    private function useNameWords()
    {
        $parts = [];
        $wordCount = $this->services->table->getTableResultRange(Table::NAME_NUM_WORDS);
        while ($wordCount--) {
            // each word has the possibility of being one or two words combined
            $wordParts = [$this->services->table->getTableResultRandom(Table::NAME_WORDS)];
            if ($this->services->random->percentile('Name has two words') > 75) {
                $wordParts[] = $this->services->table->getTableResultRandom(Table::NAME_WORDS);
            }

            if ($this->services->random->percentile('Name has prefix') > 90) {
                array_unshift($wordParts, $this->services->table->getTableResultRandom(Table::NAME_PREFIXES));
            }

            if ($this->services->random->percentile('Name has suffix') > 90) {
                array_push($wordParts, $this->services->table->getTableResultRandom(Table::NAME_SUFFIXES));
            }

            $parts[] = implode($wordParts);
        }

        return implode(' ', $parts);
    }

    /**
     * @return string name
     */
    private function useNameSyllables()
    {
        $wordCount = $this->services->table->getTableResultRange(Table::NAME_NUM_WORDS);

        $parts = [];
        while ($wordCount--) {
            $numSyllables = $this->services->table->getTableResultRange(Table::NAME_NUM_SYLLABLES);

            $wordParts = [];
            while ($numSyllables--) {
                $wordParts[] = $this->services->table->getTableResultRange(Table::SYLLABLES);
            }
            $parts[] = implode($wordParts);
        }

        return implode(' ', $parts);
    }
}
