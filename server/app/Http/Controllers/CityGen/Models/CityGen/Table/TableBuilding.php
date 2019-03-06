<?php

namespace App\Http\Controllers\CityGen\Models\CityGen\Table;

use App\Http\Controllers\CityGen\Models\Common\MinMax;

class TableBuilding
{
    /** @var string Building enum */
    public $building;
    /** @var MinMax */
    public $qualityMinMax;

    /**
     * TableBuilding constructor.
     * @param string $building
     * @param MinMax $qualityMinMax
     */
    public function __construct(string $building, MinMax $qualityMinMax)
    {
        $this->building = $building;
        $this->qualityMinMax = $qualityMinMax;
    }
}
