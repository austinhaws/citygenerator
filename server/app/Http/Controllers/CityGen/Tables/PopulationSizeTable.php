<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;

class PopulationSizeTable extends BaseTable
{

    function getTable()
    {
        return array(
            PopulationType::THORP => array(
                MinMax::MIN => 20,
                MinMax::MAX => 80,
            ),
            PopulationType::HAMLET => array(
                MinMax::MIN => 81,
                MinMax::MAX => 400,
            ),
            PopulationType::VILLAGE => array(
                MinMax::MIN => 401,
                MinMax::MAX => 900,
            ),
            PopulationType::SMALL_TOWN => array(
                MinMax::MIN => 901,
                MinMax::MAX => 2000,
            ),
            PopulationType::LARGE_TOWN => array(
                MinMax::MIN => 2001,
                MinMax::MAX => 5000,
            ),
            PopulationType::SMALL_CITY => array(
                MinMax::MIN => 5001,
                MinMax::MAX => 12000,
            ),
            PopulationType::LARGE_CITY => array(
                MinMax::MIN => 12001,
                MinMax::MAX => 32000,
            ),
            PopulationType::METROPOLIS => array(
                MinMax::MIN => 32001,
                MinMax::MAX => 90000,
            ),
        );
    }
}
