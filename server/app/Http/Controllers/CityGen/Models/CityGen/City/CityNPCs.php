<?php

namespace App\Http\Controllers\CityGen\Models\CityGen\City;

class CityNPCs
{
    /** @var string */
    public $class;
    /** @var CityNPCLevelCount */
    public $levels;

    public function __construct(string $class, $levels)
    {
        $this->class = $class;
        $this->levels = $levels;
    }
}
