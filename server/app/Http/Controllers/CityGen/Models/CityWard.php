<?php

namespace App\Http\Controllers\CityGen\Models;

class CityWard
{
    /** @var string Ward:: enum */
    public $type;
    /** @var int */
    public $acres;
    /** @var bool */
    public $insideWalls;
    /** @var CityBuilding[] */
    public $buildings;
}
