<?php

namespace App\Http\Common\Tables;

abstract class BaseTable
{

    const SPECIFIER_DICTIONARY_NAME = ':';
    const SPECIFIER_REPLACEABLE = '*';

    const CONSONANTS = 'consonants';
    const START = 'start';
    const VOWELS = 'vowels';

    const CONSONANTS_REPLACEABLE = BaseTable::SPECIFIER_REPLACEABLE . BaseTable::CONSONANTS;
    const VOWELS_REPLACEABLE = BaseTable::SPECIFIER_REPLACEABLE . BaseTable::VOWELS;

    /**
     * @return array the actual table
     */
    abstract function getTable();

    /**
     * @param string $tableName
     * @return string table name with link specifiers for the converter to understand
     */
    static function tableLink(string $tableName)
    {
        return "{BaseTable::SPECIFIER_DICTIONARY_NAME}$tableName{BaseTable::SPECIFIER_DICTIONARY_NAME}";
    }

    static function replaceable(string $word)
    {
        return "{BaseTable::SPECIFIER_REPLACEABLE}$word";
    }
}
