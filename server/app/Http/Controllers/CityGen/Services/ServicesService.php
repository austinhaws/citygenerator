<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Services\RandomCity\RandomAcresStructuresService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;
use App\Http\Controllers\CityGen\Util\TestRandomService;

class ServicesService
{

    /** @var RandomCityPopulationService  */
    public $randomCityPopulationService;
    /** @var RandomCityService  */
    public $randomCityService;
    /** @var RandomService|TestRandomService  */
    public $randomService;
    /** @var TableService  */
    public $tableService;
    /** @var RandomAcresStructuresService */
    public $randomAcresStructuresService;

    public function __construct(
        ?RandomAcresStructuresService $randomAcresStructuresService,
        ?RandomCityPopulationService $randomCityPopulationService,
        ?RandomCityService $randomCityService,
        ?RandomService $randomService,
        ?TableService $tableService
    )
    {
        $this->randomAcresStructuresService = $randomAcresStructuresService;
        $this->randomCityPopulationService = $randomCityPopulationService;
        $this->randomCityService = $randomCityService;
        $this->randomService = $randomService;
        $this->tableService = $tableService;
    }
}
