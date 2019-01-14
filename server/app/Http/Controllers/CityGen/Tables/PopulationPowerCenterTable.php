<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;

class PopulationPowerCenterTable extends BaseTable
{
    function getTable()
    {
        return array(
            PopulationType::THORP => array(
                MinMax::MIN => 0,
                MinMax::MAX => 1,
            ),
            PopulationType::HAMLET => array(
                MinMax::MIN => 0,
                MinMax::MAX => 2,
            ),
            PopulationType::VILLAGE => array(
                MinMax::MIN => 1,
                MinMax::MAX => 3,
            ),
            PopulationType::SMALL_TOWN => array(
                MinMax::MIN => 1,
                MinMax::MAX => 4,
            ),
            PopulationType::LARGE_TOWN => array(
                MinMax::MIN => 2,
                MinMax::MAX => 5,
            ),
            PopulationType::SMALL_CITY => array(
                MinMax::MIN => 3,
                MinMax::MAX => 6,
            ),
            PopulationType::LARGE_CITY => array(
                MinMax::MIN => 4,
                MinMax::MAX => 7,
            ),
            PopulationType::METROPOLIS => array(
                MinMax::MIN => 5,
                MinMax::MAX => 10,
            ),
        );
    }
}
