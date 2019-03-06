<?php

namespace App\Http\Common\Tables;

abstract class BaseTable
{

    const SPECIFIER_CONVERTIBLE = '*';
    const SPECIFIER_DICTIONARY_NAME = ':';
    const SPECIFIER_INCONVERTIBLE = '!';
    const SPECIFIER_OPTIONAL_PERCENT = '%';

    const CONSONANTS = 'consonants';
    const START = 'start';
    const VOWELS = 'vowels';

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
        return BaseTable::SPECIFIER_DICTIONARY_NAME . $tableName . BaseTable::SPECIFIER_DICTIONARY_NAME;
    }

    static function convertible(string $word)
    {
        return BaseTable::SPECIFIER_CONVERTIBLE . $word;
    }

    static function inconvertible(string $word)
    {
        return BaseTable::SPECIFIER_INCONVERTIBLE . $word;
    }
}
