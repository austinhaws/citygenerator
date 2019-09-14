<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\CityGen\Constants\Integration;


class RacePercentsTable extends BaseTable
{
    function getTable()
    {
        return array(
            Integration::ISOLATED => array(
                0 => 0.996,
                1 => 0.002,
                2 => 0.001,
                3 => 0.001,
                4 => 0.001,
                5 => 0.001,
                6 => 0.001,
                7 => 0.001,
            ),
            Integration::MIXED => array(
                0 => 0.79,
                1 => 0.09,
                2 => 0.05,
                3 => 0.03,
                4 => 0.02,
                5 => 0.01,
                6 => 0.01,
                7 => 0.01,
            ),
            Integration::INTEGRATED => array(
                0 => 0.37,
                1 => 0.20,
                2 => 0.18,
                3 => 0.10,
                4 => 0.07,
                5 => 0.05,
                6 => 0.03,
                7 => 0.01,
            ),
        );
    }
}
