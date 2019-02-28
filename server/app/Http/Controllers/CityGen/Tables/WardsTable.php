<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;
use App\Http\Controllers\CityGen\Constants\Ward;


class WardsTable extends BaseTable
{
    function getTable()
    {
        return array(
            Ward::ADMINISTRATION,
            Ward::CRAFTSMEN,
            Ward::GATE,
            Ward::MARKET,
            Ward::MERCHANT,
            Ward::MILITARY,
            Ward::ODORIFEROUS,
            Ward::PATRICIATE,
            Ward::RIVER,
            Ward::SEA,
            Ward::SHANTY,
            Ward::SLUM,
        );
    }
}
