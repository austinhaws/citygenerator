<?php

namespace App\Http\Controllers\Dictionary\Tables;

use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;


class PhrasesTable extends BaseTable
{
    const CONSONANTS = 'consonants';
    const CONSONANTS_WILD = '*consonants';
    const VOWELS = 'vowels';
    const VOWELS_WILD = '*vowels';

    function getTable()
    {
        return [
            DictionaryTable::PHRASES_ELF => DictionaryTable::getTable(DictionaryTable::PHRASES_ELF)->getTable(),
            DictionaryTable::PHRASES_GOBLIN => DictionaryTable::getTable(DictionaryTable::PHRASES_GOBLIN)->getTable(),
            DictionaryTable::PHRASES_TOLKIEN_BLACK_SPEECH => DictionaryTable::getTable(DictionaryTable::PHRASES_TOLKIEN_BLACK_SPEECH)->getTable(),
            DictionaryTable::PHRASES_UNDEAD => DictionaryTable::getTable(DictionaryTable::PHRASES_UNDEAD)->getTable(),
        ];
    }
}
