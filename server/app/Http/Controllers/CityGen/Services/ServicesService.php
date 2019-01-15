<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;

class ServicesService
{

    /** @var RandomCityPopulationService  */
    public $randomCityPopulationService;
    /** @var RandomCityService  */
    public $randomCityService;
    /** @var RandomService  */
    public $randomService;
    /** @var TableService  */
    public $tableService;

    public function __construct(
        ?RandomCityPopulationService $randomCityPopulationService,
        ?RandomCityService $randomCityService,
        ?RandomService $randomService,
        ?TableService $tableService
    )
    {
        $this->randomCityPopulationService = $randomCityPopulationService;
        $this->randomCityService = $randomCityService;
        $this->randomService = $randomService;
        $this->tableService = $tableService;
    }
}
