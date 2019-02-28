<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;


class NameSuffixesTable extends BaseTable
{
    function getTable()
    {
        return array(
            'ist',
            'er',
            'or',
            'ant',
            'ment',
            'age',
            'tion',
            'sion',
            'ing',
            'ful',
            'al',
            'ive',
            'ing',
            'ness',
        );
    }
}
