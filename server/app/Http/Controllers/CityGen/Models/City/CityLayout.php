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

    /**
     * @param int $x
     * @param int $y
     * @return LayoutCell|null
     */
    public function getCell(int $x, int $y)
    {
        return isset($this->cells[$y][$x]) ? $this->cells[$y][$x] : null;
    }
}
