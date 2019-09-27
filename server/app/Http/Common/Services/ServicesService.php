<?php

namespace App\Http\Common\Services;

use App\Http\Controllers\CityGen\Services\ListsService;
use App\Http\Controllers\CityGen\Services\PostDataService;
use App\Http\Controllers\CityGen\Services\RandomCity\Layout\RandomLayoutService;
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
use App\Http\Controllers\CityGen\Services\RandomCity\UTF8Service;
use App\Http\Controllers\CityGen\Services\TableService;
use App\Http\Controllers\CityGen\Util\TestRandomService;
use App\Http\Controllers\Dictionary\Services\ConvertService;

class ServicesService
{
    /** @var ConvertService */
    public $dictionaryConvert;
    /** @var ListsService */
    public $lists;
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
    public $randomGuilds;
    /** @var RandomLayoutService */
    public $randomLayout;
    /** @var RandomNameService */
    public $randomName;
    /** @var RandomPowerCentersService */
    public $randomPowerCenters;
    /** @var RandomProfessionsService */
    public $randomProfessions;
    /** @var RandomRacesService */
    public $randomRaces;
    /** @var RandomSeaRiverMilitaryGatesService */
    public $randomSeaRiverMilitaryGates;
    /** @var RandomWardsService */
    public $randomWards;
    /** @var TableService */
    public $table;
    /** @var UTF8Service */
    public $utf8Service;

    public function __construct()
    {
        $this->dictionaryConvert = new ConvertService($this);
        $this->lists = new ListsService($this);
        $this->postData = new PostDataService($this);
        $this->random = new RandomService($this);
        $this->randomAcresStructures = new RandomAcresStructuresService($this);
        $this->randomBuildings = new RandomBuildingsService($this);
        $this->randomCityPopulation = new RandomCityPopulationService($this);
        $this->randomCity = new RandomCityService($this);
        $this->randomCommodities = new RandomCommoditiesService($this);
        $this->randomFamous = new RandomFamousService($this);
        $this->randomGuilds = new RandomGuildsService($this);
        $this->randomLayout = new RandomLayoutService($this);
        $this->randomName = new RandomNameService($this);
        $this->randomPowerCenters = new RandomPowerCentersService($this);
        $this->randomProfessions = new RandomProfessionsService($this);
        $this->randomRaces = new RandomRacesService($this);
        $this->randomSeaRiverMilitaryGates = new RandomSeaRiverMilitaryGatesService($this);
        $this->randomWards = new RandomWardsService($this);
        $this->table = new TableService($this);
        $this->utf8Service = new UTF8Service($this);
    }
}
