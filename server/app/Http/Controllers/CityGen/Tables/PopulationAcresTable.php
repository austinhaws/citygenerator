<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;

class PopulationAcresTable extends BaseTable
{

    function getTable()
    {
        return array(
            PopulationType::THORP => array(
                MinMax::MIN => 1,
                MinMax::MAX => 9,
            ),
            PopulationType::HAMLET => array(
                MinMax::MIN => 10,
                MinMax::MAX => 19,
            ),
            PopulationType::VILLAGE => array(
                MinMax::MIN => 20,
                MinMax::MAX => 29,
            ),
            PopulationType::SMALL_TOWN => array(
                MinMax::MIN => 30,
                MinMax::MAX => 39,
            ),
            PopulationType::LARGE_TOWN => array(
                MinMax::MIN => 40,
                MinMax::MAX => 79,
            ),
            PopulationType::SMALL_CITY => array(
                MinMax::MIN => 80,
                MinMax::MAX => 120,
            ),
            PopulationType::LARGE_CITY => array(
                MinMax::MIN => 121,
                MinMax::MAX => 149,
            ),
            PopulationType::METROPOLIS => array(
                MinMax::MIN => 150,
                MinMax::MAX => 200,
            ),
        );
    }
}
