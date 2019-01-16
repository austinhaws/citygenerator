<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Models\City;
use App\Http\Controllers\CityGen\Models\PostData;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;
use App\Http\Controllers\CityGen\Util\TestRoll;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class RandomCityPopulationServiceTest extends BaseTestCase
{
    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService::determinePopulation
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService::randomPopulationSize
     */
    public function testGetTableResultRange_populationTypeGiven()
    {
        foreach (PopulationType::getConstants() as $populationType) {
            $this->services->randomService->setRolls([new TestRoll('Random Population Size', TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY)]);

            $postData = new PostData();
            $postData->populationType = $populationType;

            $city = new City();
            $this->services->randomCityPopulationService->determinePopulation($city, $postData);

            $this->assertSame($populationType, $city->populationType);
        }
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService::determinePopulation
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService::randomPopulationSize
     */
    public function testGetTableResultRange_random()
    {
        $this->services->randomService->setRolls([
            new TestRoll('getTableResultRandom-PopulationTypeTable', 0, 0, 7),
            new TestRoll('Random Population Size', 30, 20, 80),
        ]);

        $postData = new PostData();
        $postData->populationType = RandomService::RANDOM;

        $city = new City();
        $this->services->randomCityPopulationService->determinePopulation($city, $postData);

        $this->assertSame(PopulationType::THORP, $city->populationType);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService::randomPopulationSize
     */
    public function testGetTableResultRange_userEntered_low()
    {
        $this->services->randomService->setRolls([
            new TestRoll('getTableResultRandom-PopulationTypeTable', 0, 0, 7),
        ]);

        $postData = new PostData();
        $postData->populationType = 1;

        $city = new City();
        $this->services->randomCityPopulationService->determinePopulation($city, $postData);

        $this->assertSame(PopulationType::THORP, $city->populationType);
        $this->assertSame(20, $city->populationSize);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService::randomPopulationSize
     */
    public function testGetTableResultRange_userEntered_mid()
    {
        $this->services->randomService->setRolls([
            new TestRoll('getTableResultRandom-PopulationTypeTable', 0, 0, 7),
        ]);

        $postData = new PostData();
        $postData->populationType = 1500;

        $city = new City();
        $this->services->randomCityPopulationService->determinePopulation($city, $postData);

        $this->assertSame(PopulationType::SMALL_TOWN, $city->populationType);
        $this->assertSame(1500, $city->populationSize);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomCityPopulationService::randomPopulationSize
     */
    public function testGetTableResultRange_userEntered_big()
    {
        $this->services->randomService->setRolls([
            new TestRoll('getTableResultRandom-PopulationTypeTable', 0,0, 7),
        ]);

        $postData = new PostData();
        $postData->populationType = 999999999;

        $city = new City();
        $this->services->randomCityPopulationService->determinePopulation($city, $postData);

        $this->assertSame(PopulationType::METROPOLIS, $city->populationType);
        $this->assertSame(999999999, $city->populationSize);
    }
}
