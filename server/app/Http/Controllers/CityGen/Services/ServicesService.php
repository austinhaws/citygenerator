<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Services\RandomCity\RandomAcresStructuresService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomCityService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;
use App\Http\Controllers\CityGen\Util\TestRandomService;

class ServicesService
{

    /** @var RandomCityPopulationService */
    public $randomCityPopulationService;
    /** @var RandomCityService */
    public $randomCityService;
    /** @var RandomService|TestRandomService */
    public $randomService;
    /** @var TableService */
    public $tableService;
    /** @var RandomAcresStructuresService */
    public $randomAcresStructuresService;
    /** @var PostDataService */
    public $postDataService;
    /** @var RandomSeaRiverMilitaryGatesService */
    public $randomSeaRiverMilitaryGatesService;

    public function __construct(
        ?PostDataService $oostDataService = null,
        ?RandomAcresStructuresService $randomAcresStructuresService = null,
        ?RandomCityPopulationService $randomCityPopulationService = null,
        ?RandomCityService $randomCityService = null,
        ?RandomSeaRiverMilitaryGatesService $randomSeaRiverMilitaryGatesService = null,
        ?RandomService $randomService = null,
        ?TableService $tableService = null
    )
    {
        $this->postDataService = $oostDataService;
        $this->randomAcresStructuresService = $randomAcresStructuresService;
        $this->randomCityPopulationService = $randomCityPopulationService;
        $this->randomCityService = $randomCityService;
        $this->randomSeaRiverMilitaryGatesService = $randomSeaRiverMilitaryGatesService;
        $this->randomService = $randomService;
        $this->tableService = $tableService;
    }
}
