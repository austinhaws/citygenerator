<?php

namespace App\Http\Controllers\Dictionary\Tables;

use App\Http\Common\Tables\BaseTable;

class PhrasesBlackSpeechTable extends BaseTable
{
    function getTable()
    {
        return [
            'a' => PhrasesTable::VOWELS_WILD,
            'b' => PhrasesTable::CONSONANTS_WILD,
            'c' => PhrasesTable::CONSONANTS_WILD,
            'd' => PhrasesTable::CONSONANTS_WILD,
            'e' => PhrasesTable::VOWELS_WILD,
            'f' => PhrasesTable::CONSONANTS_WILD,
            'g' => PhrasesTable::CONSONANTS_WILD,
            'h' => PhrasesTable::CONSONANTS_WILD,
            'i' => PhrasesTable::VOWELS_WILD,
            'j' => PhrasesTable::CONSONANTS_WILD,
            'k' => PhrasesTable::CONSONANTS_WILD,
            'l' => PhrasesTable::CONSONANTS_WILD,
            'm' => PhrasesTable::CONSONANTS_WILD,
            'n' => PhrasesTable::CONSONANTS_WILD,
            'o' => PhrasesTable::VOWELS_WILD,
            'p' => PhrasesTable::CONSONANTS_WILD,
            'q' => PhrasesTable::CONSONANTS_WILD,
            'r' => PhrasesTable::CONSONANTS_WILD,
            's' => PhrasesTable::CONSONANTS_WILD,
            't' => PhrasesTable::CONSONANTS_WILD,
            'u' => PhrasesTable::VOWELS_WILD,
            'v' => PhrasesTable::CONSONANTS_WILD,
            'w' => PhrasesTable::CONSONANTS_WILD,
            'x' => PhrasesTable::CONSONANTS_WILD,
            'y' => PhrasesTable::CONSONANTS_WILD,
            'z' => PhrasesTable::CONSONANTS_WILD,
            PhrasesTable::VOWELS => ['a', 'u', 'i', 'ú', 'â', 'h', 'o', 'e'],
            PhrasesTable::CONSONANTS => ['h', 'g', 's', 'r', 'k', 'b', 'l', 'm', 'n', 'z', 'a', 'd', 't', 'p', 'r', 'f', 'u'],
        ];
    }
}
