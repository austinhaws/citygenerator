<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;

class PopulationInfluencePointsTable extends BaseTable
{
    function getTable()
    {
        return array(
            PopulationType::THORP => array(
                MinMax::MIN => 18,
                MinMax::MAX => 23,
            ),
            PopulationType::HAMLET => array(
                MinMax::MIN => 31,
                MinMax::MAX => 38,
            ),
            PopulationType::VILLAGE => array(
                MinMax::MIN => 50,
                MinMax::MAX => 62,
            ),
            PopulationType::SMALL_TOWN => array(
                MinMax::MIN => 81,
                MinMax::MAX => 89,
            ),
            PopulationType::LARGE_TOWN => array(
                MinMax::MIN => 188,
                MinMax::MAX => 353,
            ),
            PopulationType::SMALL_CITY => array(
                MinMax::MIN => 1807,
                MinMax::MAX => 2209,
            ),
            PopulationType::LARGE_CITY => array(
                MinMax::MIN => 13520,
                MinMax::MAX => 16830,
            ),
            PopulationType::METROPOLIS => array(
                MinMax::MIN => 29982,
                MinMax::MAX => 36645,
            ),
        );
    }
}
