<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Constants\Integration;
use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Constants\Race;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Models\Post\PostRaceRatio;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;
use App\Http\Controllers\CityGen\Util\TestRoll;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class RandomRacesServiceTest extends BaseTestCase
{
    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomRacesService::determineRaces
     */
    public function testRaces()
    {
        $postData = new PostData();
        $postData->professions = BooleanRandom::FALSE;
        $postData->racialMix = RandomService::RANDOM;

        $city = new City();
        $city->populationType = PopulationType::HAMLET;
        $city->populationSize = 98;

        $this->services->random->setRolls([
            new TestRoll('Racial Mix', 2, 1, 3),
            new TestRoll('RacesRandomTable: range', 33, 1, 100),
            new TestRoll('Resident Race ratio range', function (TestRoll $roll, String $name, int $min, int $max) {return $max;}, 0, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->services->randomRaces->determineRaces($city, $postData);
        $this->services->random->verifyRolls();

        $this->assertSame(Race::HUMAN, $city->races[0]->race);

        $this->assertIsSorted(array_reverse($city->races), function ($race) {
            return $race->total;
        });
        $this->assertSame(83, $city->races[0]->total);
        $this->assertSame(Integration::MIXED, $postData->racialMix);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomRacesService::determineRaces
     */
    public function testRacialMixSet()
    {
        $postData = new PostData();
        $postData->professions = BooleanRandom::FALSE;
        $postData->racialMix = Integration::INTEGRATED;

        $city = new City();
        $city->populationType = PopulationType::HAMLET;
        $city->populationSize = 98;

        $this->services->random->setRolls([
            new TestRoll('RacesRandomTable: range', 33, 1, 100),
            new TestRoll('Resident Race ratio range', function (TestRoll $roll, String $name, int $min, int $max) {return $max;}, 0, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->services->randomRaces->determineRaces($city, $postData);
        $this->services->random->verifyRolls();

        $this->assertSame(Race::HUMAN, $city->races[0]->race);

        $this->assertIsSorted(array_reverse($city->races), function ($race) {
            return $race->total;
        });
        $this->assertSame(41, $city->races[0]->total);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomRacesService::determineRaces
     */
    public function testRaceSet()
    {
        $postData = new PostData();
        $postData->professions = BooleanRandom::FALSE;
        $postData->racialMix = RandomService::RANDOM;
        $postData->race = Race::HALFORC;

        $city = new City();
        $city->populationType = PopulationType::HAMLET;
        $city->populationSize = 98;

        $this->services->random->setRolls([
            new TestRoll('Racial Mix', 2, 1, 3),
            new TestRoll('Resident Race ratio range', function (TestRoll $roll, String $name, int $min, int $max) {return $max;}, 0, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->services->randomRaces->determineRaces($city, $postData);
        $this->services->random->verifyRolls();

        $this->assertIsSorted(array_reverse($city->races), function ($race) {
            return $race->total;
        });
        $this->assertSame(5, count($city->races));
        $this->assertSame(Race::HALFORC, $city->races[0]->race);
        $this->assertSame(83, $city->races[0]->total);
        $this->assertSame(Integration::MIXED, $postData->racialMix);
    }

    public function testCustomMix_Ratio0()
    {
        $postData = new PostData();
        $postData->professions = BooleanRandom::FALSE;
        $postData->racialMix = RandomService::CUSTOM;
        $postData->raceRatio = [
            new PostRaceRatio(Race::DWARF, 0),
        ];

        $city = new City();
        $city->populationType = PopulationType::HAMLET;
        $city->populationSize = 98;

        $this->services->random->setRolls([
            new TestRoll('RacesRandomTable: range', 98, 1, 100),
            new TestRoll('Racial Mix', 2, 1, 3),
            new TestRoll('Resident Race ratio range', function (TestRoll $roll, String $name, int $min, int $max) {return $max;}, 0, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->services->randomRaces->determineRaces($city, $postData);
        $this->services->random->verifyRolls();

        $this->assertIsSorted(array_reverse($city->races), function ($race) {
            return $race->total;
        });
        $this->assertSame(5, count($city->races));
        $this->assertSame(Race::HALFORC, $city->races[0]->race);
        $this->assertSame(83, $city->races[0]->total);
        $this->assertSame(Integration::MIXED, $postData->racialMix);
    }


    public function testCustomMix_RatioOne()
    {
        $postData = new PostData();
        $postData->professions = BooleanRandom::FALSE;
        $postData->racialMix = RandomService::CUSTOM;
        $postData->raceRatio = [
            new PostRaceRatio(Race::DWARF, 80),
        ];

        $city = new City();
        $city->populationType = PopulationType::HAMLET;
        $city->populationSize = 98;

        $this->services->random->setRolls([
            new TestRoll('Resident Race ratio range', function (TestRoll $roll, String $name, int $min, int $max) {return $max;}, 0, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->services->randomRaces->determineRaces($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertIsSorted(array_reverse($city->races), function ($race) {
            return $race->total;
        });
        $this->assertSame(Race::DWARF, $city->races[0]->race);
        $this->assertSame(1, count($city->races));
        $this->assertSame(98, $city->races[0]->total);
        $this->assertSame(Integration::CUSTOM, $postData->racialMix);
    }

    public function testCustomMix_RatioSeveral()
    {
        $postData = new PostData();
        $postData->professions = BooleanRandom::FALSE;
        $postData->racialMix = RandomService::CUSTOM;
        $postData->raceRatio = [
            new PostRaceRatio(Race::DWARF, .60),
            new PostRaceRatio(Race::ELF, .80),
            new PostRaceRatio(Race::HUMAN, .5),
        ];

        $city = new City();
        $city->populationType = PopulationType::HAMLET;
        $city->populationSize = 98;

        $this->services->random->setRolls([
            new TestRoll('Resident Race ratio range', function (TestRoll $roll, String $name, int $min, int $max) {return $max;}, 0, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->services->randomRaces->determineRaces($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertIsSorted(array_reverse($city->races), function ($race) {
            return $race->total;
        });
        $this->assertSame(Race::ELF, $city->races[0]->race);
        $this->assertSame(3, count($city->races));
        $this->assertSame(43, $city->races[0]->total);
        $this->assertSame(Integration::CUSTOM, $postData->racialMix);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomRacesService::determineRaces
     */
    public function testRaceSetNoLeftOvers()
    {
        // RacePercentsTable says for 500 people in an isolated area, one of them will be human. before that, none will be human
        // isloated thorps and hamlets will have no other races in them
        for ($totalPeople = 20; $totalPeople <= 499; $totalPeople++) {
            $postData = new PostData();
            $postData->professions = BooleanRandom::FALSE;
            $postData->racialMix = Integration::ISOLATED;
            $postData->race = Race::ELF;

            $city = new City();
            $city->populationType = PopulationType::THORP;
            $city->populationSize = $totalPeople;

            $this->services->random->setRolls([
                new TestRoll('Resident Race ratio range', 0, 0, TestRoll::ANY),
            ]);
            $this->services->randomRaces->determineRaces($city, $postData);
            $this->services->random->verifyRolls();

            $this->assertSame(1, count($city->races));
            $this->assertSame(Race::ELF, $city->races[0]->race);
            $this->assertSame($totalPeople, $city->races[0]->total);
        }
    }

    public function testMixed()
    {
        $postData = new PostData();
        $postData->professions = BooleanRandom::FALSE;
        $postData->racialMix = Integration::MIXED;
        $postData->race = Race::DWARF;

        $city = new City();
        $city->populationType = PopulationType::METROPOLIS;
        $city->populationSize = 100000;

        $this->services->random->setRolls([
            new TestRoll('Resident Race ratio range', function (TestRoll $roll, String $name, int $min, int $max) {return $min + floor(($max - $min) / 2);}, 0, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->services->randomRaces->determineRaces($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertIsSorted(array_reverse($city->races), function ($race) {
            return $race->total;
        });
        $this->assertSame(8, count($city->races));
        $this->assertSame(Race::DWARF, $city->races[0]->race);
        $this->assertSame(89000, $city->races[0]->total);
        $this->assertSame(4500, $city->races[1]->total);
        $this->assertSame(2500, $city->races[2]->total);
        $this->assertSame(1500, $city->races[3]->total);
        $this->assertSame(1000, $city->races[4]->total);
        $this->assertSame(500, $city->races[5]->total);
        $this->assertSame(500, $city->races[6]->total);
        $this->assertSame(500, $city->races[7]->total);
        $this->assertSame(Integration::MIXED, $postData->racialMix);
    }
}
