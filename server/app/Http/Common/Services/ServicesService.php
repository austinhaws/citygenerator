<?php

namespace App\Http\Common\Services;

use App\Http\Controllers\CityGen\Services\PostDataService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomAcresStructuresService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomBuildingsService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCommoditiesService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomFamousService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomGuildsService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomPowerCentersService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomProfessionsService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomRacesService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService;
use App\Http\Controllers\CityGen\Services\TableService;
use App\Http\Controllers\CityGen\Util\TestRandomService;
use App\Http\Controllers\Dictionary\Services\ConvertService;

class ServicesService
{
    /** @var ConvertService */
    public $dictionaryConvert;
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
    /** @var RandomCommoditiesService */
    public $randomCommodities;
    /** @var RandomFamousService */
    public $randomFamous;
    /** @var RandomGuildsService */
    public $randomGuild;
    /** @var RandomNameService */
    public $randomName;
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
        ?ConvertService $convertService = null,
        ?PostDataService $postDataService = null,
        ?RandomAcresStructuresService $randomAcresStructuresService = null,
        ?RandomBuildingsService $randomBuildingsService = null,
        ?RandomCityPopulationService $randomCityPopulationService = null,
        ?RandomCityService $randomCityService = null,
        ?RandomCommoditiesService $randomCommodities = null,
        ?RandomFamousService $randomFamous = null,
        ?RandomGuildsService $randomGuildService = null,
        ?RandomNameService $randomNameService = null,
        ?RandomProfessionsService $randomProfessions = null,
        ?RandomPowerCentersService $randomPowerCenters = null,
        ?RandomRacesService $randomRacesService = null,
        ?RandomSeaRiverMilitaryGatesService $randomSeaRiverMilitaryGatesService = null,
        ?RandomService $randomService = null,
        ?RandomWardsService $randomWardsService = null,
        ?TableService $tableService = null
    )
    {
        $this->dictionaryConvert = $convertService;
        $this->postData = $postDataService;
        $this->random = $randomService;
        $this->randomAcresStructures = $randomAcresStructuresService;
        $this->randomBuildings = $randomBuildingsService;
        $this->randomCityPopulation = $randomCityPopulationService;
        $this->randomCity = $randomCityService;
        $this->randomCommodities = $randomCommodities;
        $this->randomFamous = $randomFamous;
        $this->randomGuild = $randomGuildService;
        $this->randomName = $randomNameService;
        $this->randomPowerCenters = $randomPowerCenters;
        $this->randomProfessions = $randomProfessions;
        $this->randomRacesService = $randomRacesService;
        $this->randomSeaRiverMilitaryGates = $randomSeaRiverMilitaryGatesService;
        $this->randomWards = $randomWardsService;
        $this->table = $tableService;
    }
}
