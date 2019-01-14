<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;

class PopulationNumStructuresTable extends BaseTable
{

    function getTable()
    {
        return array(
            PopulationType::THORP => array(
                MinMax::MIN => 0,
                MinMax::MAX => 4,
            ),
            PopulationType::HAMLET => array(
                MinMax::MIN => 5,
                MinMax::MAX => 9,
            ),
            PopulationType::VILLAGE => array(
                MinMax::MIN => 10,
                MinMax::MAX => 14,
            ),
            PopulationType::SMALL_TOWN => array(
                MinMax::MIN => 15,
                MinMax::MAX => 19,
            ),
            PopulationType::LARGE_TOWN => array(
                MinMax::MIN => 20,
                MinMax::MAX => 39,
            ),
            PopulationType::SMALL_CITY => array(
                MinMax::MIN => 40,
                MinMax::MAX => 49,
            ),
            PopulationType::LARGE_CITY => array(
                MinMax::MIN => 50,
                MinMax::MAX => 69,
            ),
            PopulationType::METROPOLIS => array(
                MinMax::MIN => 60,
                MinMax::MAX => 80,
            ),
        );
    }
}
