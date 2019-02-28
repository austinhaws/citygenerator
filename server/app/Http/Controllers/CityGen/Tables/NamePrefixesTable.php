<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;


class NamePrefixesTable extends BaseTable
{
    function getTable()
    {
        return array(
            'anti',
            'dis',
            'pro',
            're',
            'self',
            'un',
        );
    }
}
