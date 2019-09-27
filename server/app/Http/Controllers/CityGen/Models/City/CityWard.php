<?php

namespace App\Http\Controllers\CityGen\Models\City;

class CityWard
{
    private static $nextId = 1;

    /** @var int unique ID for the ward in the city */
    public $id;
    /** @var string Ward:: enum */
    public $type;
    /** @var int */
    public $acres;
    /** @var bool */
    public $insideWalls;
    /** @var CityBuilding[] */
    public $buildings = [];

    public function __construct()
    {
        $this->id = $this::$nextId++;
    }
}
