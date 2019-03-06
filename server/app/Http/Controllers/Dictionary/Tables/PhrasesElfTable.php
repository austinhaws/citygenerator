<?php

namespace App\Http\Controllers\Dictionary\Tables;

use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;

class PhrasesElfTable extends BaseTable
{
    function getTable()
    {
        return [
            'a' => BaseTable::convertible(BaseTable::VOWELS),
            'b' => BaseTable::convertible(BaseTable::CONSONANTS),
            'c' => BaseTable::convertible(BaseTable::CONSONANTS),
            'd' => BaseTable::convertible(BaseTable::CONSONANTS),
            'e' => BaseTable::convertible(BaseTable::VOWELS),
            'f' => BaseTable::convertible(BaseTable::CONSONANTS),
            'g' => BaseTable::convertible(BaseTable::CONSONANTS),
            'h' => BaseTable::convertible(BaseTable::CONSONANTS),
            'i' => BaseTable::convertible(BaseTable::VOWELS),
            'j' => BaseTable::convertible(BaseTable::CONSONANTS),
            'k' => BaseTable::convertible(BaseTable::CONSONANTS),
            'l' => BaseTable::convertible(BaseTable::CONSONANTS),
            'm' => BaseTable::convertible(BaseTable::CONSONANTS),
            'n' => BaseTable::convertible(BaseTable::CONSONANTS),
            'o' => BaseTable::convertible(BaseTable::VOWELS),
            'p' => BaseTable::convertible(BaseTable::CONSONANTS),
            'q' => BaseTable::convertible(BaseTable::CONSONANTS),
            'r' => BaseTable::convertible(BaseTable::CONSONANTS),
            's' => BaseTable::convertible(BaseTable::CONSONANTS),
            't' => BaseTable::convertible(BaseTable::CONSONANTS),
            'u' => BaseTable::convertible(BaseTable::VOWELS),
            'v' => BaseTable::convertible(BaseTable::CONSONANTS),
            'w' => BaseTable::convertible(BaseTable::CONSONANTS),
            'x' => BaseTable::convertible(BaseTable::CONSONANTS),
            'y' => BaseTable::convertible(BaseTable::CONSONANTS),
            'z' => BaseTable::convertible(BaseTable::CONSONANTS),
            BaseTable::VOWELS => ['a', 'e', 'i', 'u', 'o', 'ä', 'ö', 'ë', 'á'],
            BaseTable::CONSONANTS => ['r', 'l', 'd', 't', 'h', 'ra', 'la', 'al', 'ar', 'n', 'g', 'b', 'k', 'f', 's', 'y', 'ay', 'ya', 'v', 'j', 'm', 'a', 'e', 'i', 'c', 'p', 'w', 'z', 'q', 'u', 'o'],
            BaseTable::START => BaseTable::convertible(BaseTable::tableLink(DictionaryTable::PHRASES_NAME)),
        ];
    }
}
