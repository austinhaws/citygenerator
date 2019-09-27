<?php

namespace App\Http\Controllers\CityGen\Models\City;

use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutMeta;

class City
{
    /** @var int */
    public $populationSize = null;
    /** @var string PopulationType:: */
    public $populationType = null;
    /** @var string */
    public $name = '';
    /** @var int int */
    public $numStructures = 0;
    /** @var float  */
    public $acres = 0.0;
    /** @var bool BooleanRandom:: */
    public $hasSea = BooleanRandom::FALSE;
    /** @var bool BooleanRandom:: */
    public $hasMilitary = BooleanRandom::FALSE;
    /** @var bool BooleanRandom:: */
    public $hasRiver = BooleanRandom::FALSE;
    /** @var int */
    public $numGates = 0;
    /** @var CityWard[] */
    public $wards = [];
    /** @var CityProfession[] */
    public $professions = [];
    /** @var int */
    public $influencePointsUnabsorbed = 0;

    /** @var float */
    public $wealth;
    /** @var int */
    public $goldPieceLimit;
    /** @var float */
    public $magicResources;
    /** @var float */
    public $kingIncome;

    /** @var array CityPowerCenter[] */
    public $powerCenters = [];

    /** @var string Race:: */
    public $majorityRace;
    /** @var CityRace[] */
    public $races;

    /** @var CityGuild[] */
    public $guilds = [];

    /** @var string[] */
    public $commoditiesExport = [];
    /** @var string[] */
    public $commoditiesImport = [];

    /** @var string[] */
    public $famous = [];
    /** @var string[] */
    public $infamous = [];

    // /** @var CityLayout  */
    public $layout;
}
