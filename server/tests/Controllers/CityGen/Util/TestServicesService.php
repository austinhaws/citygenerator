<?php

namespace Test\Controllers\CityGen\Util;

use App\Http\Common\Services\ServicesService;
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
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TestServicesService extends ServicesService
{
    /** @var RandomService */
    public $realRandom;
    /** @var MockObject */
    public $convertMock;
    public $realDictionaryConvert;

    public function __construct(TestCase $testCase)
    {
        parent::__construct();

        $this->realRandom = new RandomService();
        $this->realDictionaryConvert = new ConvertService($this);

        $this->dictionaryConvert = $this->convertMock = $testCase->getMockBuilder(ConvertService::class)
            ->disableOriginalConstructor()
            ->setMethods(['convert'])
            ->getMock();
        $this->postData = new PostDataService($this);
        $this->random = new TestRandomService();
        $this->randomAcresStructures = new RandomAcresStructuresService($this);
        $this->randomBuildings = new RandomBuildingsService($this);
        $this->randomCityPopulation = new RandomCityPopulationService($this);
        $this->randomCity = new RandomCityService($this);
        $this->randomCommodities = new RandomCommoditiesService($this);
        $this->randomFamous = new RandomFamousService($this);
        $this->randomGuild = new RandomGuildsService($this);
        $this->randomName = new RandomNameService($this);
        $this->randomPowerCenters = new RandomPowerCentersService($this);
        $this->randomProfessions = new RandomProfessionsService($this);
        $this->randomRacesService = new RandomRacesService($this);
        $this->randomSeaRiverMilitaryGates = new RandomSeaRiverMilitaryGatesService($this);
        $this->randomWards = new RandomWardsService($this);
        $this->table = new TableService($this);
    }
}
