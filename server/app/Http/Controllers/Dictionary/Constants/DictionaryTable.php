<?php

namespace App\Http\Controllers\Dictionary\Constants;

use App\Http\Common\Constants\BaseEnum;
use App\Http\Common\Tables\BaseTable;

class DictionaryTable extends BaseEnum
{
    const PHRASES_ELF = 'PhrasesElfTable';
    const PHRASES_GOBLIN = 'PhrasesGoblinTable';
    const PHRASES_NAME = 'PhrasesNameTable';
    const PHRASES_SAYING = 'PhrasesSayingTable';
    const PHRASES_TOLKIEN_BLACK_SPEECH = 'PhrasesBlackSpeechTable';
    const PHRASES_UNDEAD = 'PhrasesUndeadTable';


    private static $tables = [];

    /**
     * @param string $tableName
     * @return BaseTable
     */
    public static function getTable(string $tableName) {

        if (isset(DictionaryTable::$tables[$tableName])) {
            $table = DictionaryTable::$tables[$tableName];
        } else {
            $pathName = "App\Http\Controllers\Dictionary\Tables\\$tableName";
            $table = new $pathName();
            DictionaryTable::$tables[$tableName] = $table;
        }

        return $table;
    }
}
