<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;


class NameNumWordsTable extends BaseTable
{
    function getTable()
    {
        return array(
            65 => 1,
            90 => 2,
            99 => 3,
            100 => 4,
        );
    }
}
