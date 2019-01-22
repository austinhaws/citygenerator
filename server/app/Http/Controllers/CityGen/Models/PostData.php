<?php

namespace App\Http\Controllers\CityGen\Models;

class PostData
{
    /** @var string */
    public $populationType;
    /** @var string BooleanRandom */
    public $hasSea;
    /** @var string BooleanRandom */
    public $hasMilitary;
    /** @var string BooleanRandom */
    public $hasRiver;
    /** @var string BooleanRandom */
    public $hasGates;
    /** @var WardAdded[] */
    public $wardsAdded;
    /** @var string BooleanRandom */
    public $generateBuildings;
}
