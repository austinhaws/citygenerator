<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Services\RandomCity\RandomAcresStructuresService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomBuildingsService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomPowerCentersService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomProfessionsService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomRacesService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService;
use App\Http\Controllers\CityGen\Util\TestRandomService;

class ServicesService
{

    /** @var PostDataService */
    public $postData;
    /** @var RandomService|TestRandomService */
    public $random;
    /** @var RandomAcresStructuresService */
    public $randomAcresStructures;
    /** @var RandomBuildingsService */
    public $randomBuildings;
    /** @var RandomCityPopulationService */
    public $randomCityPopulation;
    /** @var RandomCityService */
    public $randomCity;
    /** @var RandomPowerCentersService */
    public $randomPowerCenters;
    /** @var RandomProfessionsService */
    public $randomProfessions;
    /** @var RandomRacesService */
    public $randomRacesService;
    /** @var RandomSeaRiverMilitaryGatesService */
    public $randomSeaRiverMilitaryGates;
    /** @var RandomWardsService */
    public $randomWards;
    /** @var TableService */
    public $table;

    public function __construct(
        ?PostDataService $oostDataService = null,
        ?RandomAcresStructuresService $randomAcresStructuresService = null,
        ?RandomBuildingsService $randomBuildingsService = null,
        ?RandomCityPopulationService $randomCityPopulationService = null,
        ?RandomCityService $randomCityService = null,
        ?RandomProfessionsService $randomProfessions = null,
        ?RandomPowerCentersService $randomPowerCenters = null,
        ?RandomRacesService $randomRacesService = null,
        ?RandomSeaRiverMilitaryGatesService $randomSeaRiverMilitaryGatesService = null,
        ?RandomService $randomService = null,
        ?RandomWardsService $randomWardsService = null,
        ?TableService $tableService = null
    )
    {
        $this->postData = $oostDataService;
        $this->random = $randomService;
        $this->randomAcresStructures = $randomAcresStructuresService;
        $this->randomBuildings = $randomBuildingsService;
        $this->randomCityPopulation = $randomCityPopulationService;
        $this->randomCity = $randomCityService;
        $this->randomPowerCenters = $randomPowerCenters;
        $this->randomProfessions = $randomProfessions;
        $this->randomRacesService = $randomRacesService;
        $this->randomSeaRiverMilitaryGates = $randomSeaRiverMilitaryGatesService;
        $this->randomWards = $randomWardsService;
        $this->table = $tableService;
    }
}
