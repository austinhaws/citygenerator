<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;

class GuildModifiersTable extends BaseTable
{
    function getTable()
    {
        return array(
            PopulationType::THORP => array(
                MinMax::MIN => 0,
                MinMax::MAX => 0,
            ),
            PopulationType::HAMLET => array(
                MinMax::MIN => 0,
                MinMax::MAX => 0,
            ),
            PopulationType::VILLAGE => array(
                MinMax::MIN => 0,
                MinMax::MAX => 2,
            ),
            PopulationType::SMALL_TOWN => array(
                MinMax::MIN => 0,
                MinMax::MAX => 3,
            ),
            PopulationType::LARGE_TOWN => array(
                MinMax::MIN => 0,
                MinMax::MAX => 4,
            ),
            PopulationType::SMALL_CITY => array(
                MinMax::MIN => 0,
                MinMax::MAX => 5,
            ),
            PopulationType::LARGE_CITY => array(
                MinMax::MIN => 0,
                MinMax::MAX => 6,
            ),
            PopulationType::METROPOLIS => array(
                MinMax::MIN => 0,
                MinMax::MAX => 7,
            ),
        );
    }
}
