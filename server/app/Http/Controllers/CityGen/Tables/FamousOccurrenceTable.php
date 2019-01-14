<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;

class FamousOccurrenceTable extends BaseTable
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
                MinMax::MAX => 1,
            ),
            PopulationType::VILLAGE => array(
                MinMax::MIN => 0,
                MinMax::MAX => 2,
            ),
            PopulationType::SMALLTOWN => array(
                MinMax::MIN => 1,
                MinMax::MAX => 3,
            ),
            PopulationType::LARGETOWN => array(
                MinMax::MIN => 1,
                MinMax::MAX => 4,
            ),
            PopulationType::SMALLCITY => array(
                MinMax::MIN => 2,
                MinMax::MAX => 4,
            ),
            PopulationType::LARGECITY => array(
                MinMax::MIN => 3,
                MinMax::MAX => 7,
            ),
            PopulationType::METROPOLIS => array(
                MinMax::MIN => 4,
                MinMax::MAX => 8,
            ),
        );
    }
}
