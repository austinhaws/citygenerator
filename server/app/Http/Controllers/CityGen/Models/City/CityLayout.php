<?php

namespace App\Http\Controllers\CityGen\Models\City;

use App\Http\Controllers\CityGen\Models\City\Layout\LayoutCell;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutMap;

class CityLayout
{
    /** @var LayoutCell[][] */
    public $cells;

    public function __construct(LayoutMap $layoutMap)
    {
        $this->cells = $layoutMap->cells;
    }
}
