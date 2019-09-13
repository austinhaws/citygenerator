<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\CityGen\Constants\PopulationType;


class MaxWardsByPopulationType extends BaseTable
{

    function getTable()
    {
        return [
            PopulationType::THORP => 2,
            PopulationType::HAMLET => 4,
            PopulationType::VILLAGE => 8,
            PopulationType::SMALL_TOWN => null,
            PopulationType::LARGE_TOWN => null,
            PopulationType::SMALL_CITY => null,
            PopulationType::LARGE_CITY => null,
            PopulationType::METROPOLIS => null,
        ];
    }
}
