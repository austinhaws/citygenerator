<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;


class NameWordsCountTable extends BaseTable
{
    function getTable()
    {
        return array(
            50 => 2,
            65 => 3,
            70 => 4,
        );
    }
}
