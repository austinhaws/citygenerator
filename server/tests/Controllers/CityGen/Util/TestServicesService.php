<?php

namespace Test\Controllers\CityGen\Util;

use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityService;
use App\Http\Controllers\CityGen\Services\ServicesService;
use App\Http\Controllers\CityGen\Services\TableService;
use App\Http\Controllers\CityGen\Util\TestRandomService;

class TestServicesService extends ServicesService
{
    public function __construct()
    {
        parent::__construct(null, null, null, null);

        $this->randomService = new TestRandomService();

        $this->tableService = new TableService($this);
        $this->randomCityPopulationService = new RandomCityPopulationService($this);
        $this->randomCityService = new RandomCityService($this);
    }
}
