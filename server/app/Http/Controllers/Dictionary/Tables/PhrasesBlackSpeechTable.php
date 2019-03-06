<?php

namespace App\Http\Controllers\Dictionary\Tables;

use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;

class PhrasesBlackSpeechTable extends BaseTable
{
    function getTable()
    {
        return [
            'a' => BaseTable::VOWELS_REPLACEABLE,
            'b' => BaseTable::CONSONANTS_REPLACEABLE,
            'c' => BaseTable::CONSONANTS_REPLACEABLE,
            'd' => BaseTable::CONSONANTS_REPLACEABLE,
            'e' => BaseTable::VOWELS_REPLACEABLE,
            'f' => BaseTable::CONSONANTS_REPLACEABLE,
            'g' => BaseTable::CONSONANTS_REPLACEABLE,
            'h' => BaseTable::CONSONANTS_REPLACEABLE,
            'i' => BaseTable::VOWELS_REPLACEABLE,
            'j' => BaseTable::CONSONANTS_REPLACEABLE,
            'k' => BaseTable::CONSONANTS_REPLACEABLE,
            'l' => BaseTable::CONSONANTS_REPLACEABLE,
            'm' => BaseTable::CONSONANTS_REPLACEABLE,
            'n' => BaseTable::CONSONANTS_REPLACEABLE,
            'o' => BaseTable::VOWELS_REPLACEABLE,
            'p' => BaseTable::CONSONANTS_REPLACEABLE,
            'q' => BaseTable::CONSONANTS_REPLACEABLE,
            'r' => BaseTable::CONSONANTS_REPLACEABLE,
            's' => BaseTable::CONSONANTS_REPLACEABLE,
            't' => BaseTable::CONSONANTS_REPLACEABLE,
            'u' => BaseTable::VOWELS_REPLACEABLE,
            'v' => BaseTable::CONSONANTS_REPLACEABLE,
            'w' => BaseTable::CONSONANTS_REPLACEABLE,
            'x' => BaseTable::CONSONANTS_REPLACEABLE,
            'y' => BaseTable::CONSONANTS_REPLACEABLE,
            'z' => BaseTable::CONSONANTS_REPLACEABLE,
            BaseTable::VOWELS => ['a', 'u', 'i', 'ú', 'â', 'h', 'o', 'e'],
            BaseTable::CONSONANTS => ['h', 'g', 's', 'r', 'k', 'b', 'l', 'm', 'n', 'z', 'a', 'd', 't', 'p', 'r', 'f', 'u'],
            BaseTable::START => BaseTable::tableLink(DictionaryTable::PHRASES_NAME),
        ];
    }
}
