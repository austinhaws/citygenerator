<?php

namespace App\Http\Controllers\CityGen\Models\City;

class CityNPCs
{
    /** @var string */
    public $class;
    /** @var CityNPCLevelCount */
    public $levels;

    public function __construct(string $class)
    {
        $this->class = $class;
        $this->levels = array_map(function ($i) { return new CityNPCLevelCount($i); }, range(1, 20));
    }
}
