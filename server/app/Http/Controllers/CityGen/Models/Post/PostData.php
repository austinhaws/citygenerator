<?php

namespace App\Http\Controllers\CityGen\Models\Post;

use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;

class PostData
{
    /** @var string */
    public $name = RandomService::RANDOM;
    /** @var string */
    public $populationType = BooleanRandom::RANDOM;
    /** @var string BooleanRandom:: */
    public $hasSea = BooleanRandom::RANDOM;
    /** @var string BooleanRandom:: */
    public $hasMilitary = BooleanRandom::RANDOM;
    /** @var string BooleanRandom:: */
    public $hasRiver = BooleanRandom::RANDOM;
    /** @var string BooleanRandom:: */
    public $hasGates = BooleanRandom::RANDOM;
    /** @var WardAdded[] */
    public $wardsAdded = [];
    /** @var string BooleanRandom:: */
    public $generateBuildings = BooleanRandom::RANDOM;
    /** @var string BooleanRandom:: */
    public $professions = BooleanRandom::RANDOM;

    /** @var string Custom || Race::*/
    public $racialMix;
    /** @var PostRaceRatio[] */
    public $raceRatio;
    /** @var string Race:: major race */
    public $race = BooleanRandom::RANDOM;
    /** @var string BooleanRandom... constants*/
    public $generateLayout = BooleanRandom::TRUE;
}
