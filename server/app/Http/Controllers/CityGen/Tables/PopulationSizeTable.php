<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Models\MinMax;
use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\CityGen\Constants\PopulationType;


class PopulationSizeTable extends BaseTable
{

    function getTable()
    {
        return array(
            PopulationType::THORP => new MinMax(20, 80),
            PopulationType::HAMLET => new MinMax(81, 400),
            PopulationType::VILLAGE => new MinMax(401, 900),
            PopulationType::SMALL_TOWN => new MinMax(901, 2000),
            PopulationType::LARGE_TOWN => new MinMax(2001, 5000),
            PopulationType::SMALL_CITY => new MinMax(5001, 12000),
            PopulationType::LARGE_CITY => new MinMax(12001, 32000),
            PopulationType::METROPOLIS => new MinMax(32001, 90000),
        );
    }
}
