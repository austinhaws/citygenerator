<?php

namespace Test\Controllers\CityGen\Util;

use App\Http\Controllers\CityGen\Services\PostDataService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomAcresStructuresService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService;
use App\Http\Controllers\CityGen\Services\ServicesService;
use App\Http\Controllers\CityGen\Services\TableService;
use App\Http\Controllers\CityGen\Util\TestRandomService;

class TestServicesService extends ServicesService
{
    public function __construct()
    {
        parent::__construct();

        $this->postDataService = new PostDataService($this);
        $this->randomAcresStructuresService = new RandomAcresStructuresService($this);
        $this->randomCityPopulationService = new RandomCityPopulationService($this);
        $this->randomCityService = new RandomCityService($this);
        $this->randomService = new TestRandomService();
        $this->tableService = new TableService($this);
        $this->randomSeaRiverMilitaryGatesService = new RandomSeaRiverMilitaryGatesService($this);
    }
}
