<?php

namespace Test\Controllers\CityGen\Util;

use App\Http\Controllers\CityGen\Services\PostDataService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomAcresStructuresService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService;
use App\Http\Controllers\CityGen\Services\ServicesService;
use App\Http\Controllers\CityGen\Services\TableService;
use App\Http\Controllers\CityGen\Util\TestRandomService;

class TestServicesService extends ServicesService
{
    public function __construct()
    {
        parent::__construct();

        $this->postData = new PostDataService($this);
        $this->random = new TestRandomService();
        $this->randomAcresStructures = new RandomAcresStructuresService($this);
        $this->randomCityPopulation = new RandomCityPopulationService($this);
        $this->randomCity = new RandomCityService($this);
        $this->randomSeaRiverMilitaryGates = new RandomSeaRiverMilitaryGatesService($this);
        $this->randomWards = new RandomWardsService($this);
        $this->table = new TableService($this);
    }
}
