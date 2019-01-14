<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Constants\Ward;

class PopulationWardDensity extends BaseTable
{

    function getTable()
    {
        return array(
            PopulationType::THORP => array(
                Ward::PATRICIATE => 1,
                Ward::MERCHANT => 1,
                Ward::MILITARY => 1,
                Ward::ADMINISTRATION => 1,
                Ward::ODORIFEROUS => 2,
                Ward::CRAFTSMEN => 2,
                Ward::SEA => 2,
                Ward::RIVER => 2,
                Ward::MARKET => 3,
                Ward::GATE => 3,
                Ward::SLUM => 3,
                Ward::SHANTY => 3,
            ),
            PopulationType::HAMLET => array(
                Ward::PATRICIATE => 4,
                Ward::MERCHANT => 4,
                Ward::MILITARY => 4,
                Ward::ADMINISTRATION => 5,
                Ward::ODORIFEROUS => 5,
                Ward::CRAFTSMEN => 5,
                Ward::SEA => 6,
                Ward::RIVER => 6,
                Ward::MARKET => 7,
                Ward::GATE => 7,
                Ward::SLUM => 8,
                Ward::SHANTY => 8,
            ),
            PopulationType::VILLAGE => array(
                Ward::PATRICIATE => 9,
                Ward::MERCHANT => 9,
                Ward::MILITARY => 10,
                Ward::ADMINISTRATION => 10,
                Ward::ODORIFEROUS => 11,
                Ward::CRAFTSMEN => 11,
                Ward::SEA => 12,
                Ward::RIVER => 12,
                Ward::MARKET => 13,
                Ward::GATE => 13,
                Ward::SLUM => 14,
                Ward::SHANTY => 14,
            ),
            PopulationType::SMALL_TOWN => array(
                Ward::PATRICIATE => 15,
                Ward::MERCHANT => 15,
                Ward::MILITARY => 15,
                Ward::ADMINISTRATION => 16,
                Ward::ODORIFEROUS => 16,
                Ward::CRAFTSMEN => 16,
                Ward::SEA => 17,
                Ward::RIVER => 17,
                Ward::MARKET => 18,
                Ward::GATE => 18,
                Ward::SLUM => 19,
                Ward::SHANTY => 19,
            ),
            PopulationType::LARGE_TOWN => array(
                Ward::PATRICIATE => 29,
                Ward::MERCHANT => 21,
                Ward::MILITARY => 22,
                Ward::ADMINISTRATION => 23,
                Ward::ODORIFEROUS => 24,
                Ward::CRAFTSMEN => 25,
                Ward::SEA => 26,
                Ward::RIVER => 27,
                Ward::MARKET => 28,
                Ward::GATE => 28,
                Ward::SLUM => 29,
                Ward::SHANTY => 29,
            ),
            PopulationType::SMALL_CITY => array(
                Ward::PATRICIATE => 39,
                Ward::MERCHANT => 41,
                Ward::MILITARY => 43,
                Ward::ADMINISTRATION => 45,
                Ward::ODORIFEROUS => 47,
                Ward::CRAFTSMEN => 49,
                Ward::SEA => 51,
                Ward::RIVER => 53,
                Ward::MARKET => 55,
                Ward::GATE => 57,
                Ward::SLUM => 59,
                Ward::SHANTY => 61,
            ),
            PopulationType::LARGE_CITY => array(
                Ward::PATRICIATE => 50,
                Ward::MERCHANT => 52,
                Ward::MILITARY => 54,
                Ward::ADMINISTRATION => 56,
                Ward::ODORIFEROUS => 58,
                Ward::CRAFTSMEN => 60,
                Ward::SEA => 62,
                Ward::RIVER => 63,
                Ward::MARKET => 64,
                Ward::GATE => 66,
                Ward::SLUM => 68,
                Ward::SHANTY => 69,
            ),
            PopulationType::METROPOLIS => array(
                Ward::PATRICIATE => 60,
                Ward::MERCHANT => 62,
                Ward::MILITARY => 64,
                Ward::ADMINISTRATION => 66,
                Ward::ODORIFEROUS => 68,
                Ward::CRAFTSMEN => 70,
                Ward::SEA => 72,
                Ward::RIVER => 74,
                Ward::MARKET => 76,
                Ward::GATE => 78,
                Ward::SLUM => 80,
                Ward::SHANTY => 80,
            ),
        );
    }
}
