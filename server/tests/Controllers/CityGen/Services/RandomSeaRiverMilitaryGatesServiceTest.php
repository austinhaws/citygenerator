<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Util\TestRoll;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class RandomSeaRiverMilitaryGatesServiceTest extends BaseTestCase
{
    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService::determineZones
     */
    public function testDetermineZones_hasSeas()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = BooleanRandom::FALSE;

        // true
        $postData = new PostData();
        $postData->hasSea = BooleanRandom::TRUE;

        $this->services->random->setRolls([TestRoll::randomInstance()]);

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->assertSame(BooleanRandom::TRUE, $city->hasSea);

        // false
        $postData->hasSea = BooleanRandom::FALSE;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->assertSame(BooleanRandom::FALSE, $city->hasSea);

        // random - yes
        $this->services->random->setRolls([
            new TestRoll('Has Sea', 25, 1, 100),
            TestRoll::randomInstance(),
        ]);
        $postData->hasSea = BooleanRandom::RANDOM;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(BooleanRandom::TRUE, $city->hasSea);

        // random - no
        $this->services->random->setRolls([
            new TestRoll('Has Sea', 73, 1, 100),
            TestRoll::randomInstance(),
        ]);
        $postData->hasSea = BooleanRandom::RANDOM;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(BooleanRandom::FALSE, $city->hasSea);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService::determineZones
     */
    public function testDetermineZones_hasRiver()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = BooleanRandom::FALSE;

        // true
        $postData = new PostData();
        $postData->hasRiver = BooleanRandom::TRUE;

        $this->services->random->setRolls([TestRoll::randomInstance()]);

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->assertSame(BooleanRandom::TRUE, $city->hasRiver);

        // false
        $postData->hasRiver = BooleanRandom::FALSE;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->assertSame(BooleanRandom::FALSE, $city->hasRiver);

        // random - yes
        $this->services->random->setRolls([
            new TestRoll('Has Sea', 25, 1, 100),
            new TestRoll('Has River', 25, 1, 100),
            TestRoll::randomInstance(),
        ]);
        $postData->hasRiver = BooleanRandom::RANDOM;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(BooleanRandom::TRUE, $city->hasRiver);

        // random - no
        $this->services->random->setRolls([
            new TestRoll('Has Sea', 73, 1, 100),
            new TestRoll('Has River', 73, 1, 100),
            TestRoll::randomInstance(),
        ]);
        $postData->hasRiver = BooleanRandom::RANDOM;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(BooleanRandom::FALSE, $city->hasRiver);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService::determineZones
     */
    public function testDetermineZones_hasMilitary()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = BooleanRandom::FALSE;

        // true
        $postData = new PostData();
        $postData->hasMilitary = BooleanRandom::TRUE;

        $this->services->random->setRolls([TestRoll::randomInstance()]);

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->assertSame(BooleanRandom::TRUE, $city->hasMilitary);

        // false
        $postData->hasMilitary = BooleanRandom::FALSE;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->assertSame(BooleanRandom::FALSE, $city->hasMilitary);

        // random - yes
        $this->services->random->setRolls([
            new TestRoll('Has Sea', 7, 1, 100),
            new TestRoll('Has River', 7, 1, 100),
            new TestRoll('Has Military', 7, 1, 100),
            TestRoll::randomInstance(),
        ]);
        $postData->hasMilitary = BooleanRandom::RANDOM;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(BooleanRandom::TRUE, $city->hasMilitary);

        // random - no
        $this->services->random->setRolls([
            new TestRoll('Has Sea', 73, 1, 100),
            new TestRoll('Has River', 73, 1, 100),
            new TestRoll('Has Military', 73, 1, 100),
            TestRoll::randomInstance(),
        ]);
        $postData->hasMilitary = BooleanRandom::RANDOM;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(BooleanRandom::FALSE, $city->hasMilitary);
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomSeaRiverMilitaryGatesService::determineZones
     */
    public function testDetermineZones_hasGates()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = BooleanRandom::FALSE;

        // true
        $postData = new PostData();
        $postData->hasGates = BooleanRandom::TRUE;

        $this->services->random->setRolls([
            new TestRoll('Has Sea', 3, 1, 100),
            new TestRoll('Has River', 3, 1, 100),
            new TestRoll('Has Military', 3, 1, 100),
            new TestRoll('Num Gates', 3, 1, 4),
            TestRoll::randomInstance(),
        ]);
        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);
        $this->services->random->verifyRolls();

        $this->assertSame(3, $city->numGates);

        // false
        $postData->hasGates = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Has Sea', 3, 1, 100),
            new TestRoll('Has River', 3, 1, 100),
            new TestRoll('Has Military', 3, 1, 100),
        ]);

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);
        $this->services->random->verifyRolls();

        $this->assertSame(0, $city->numGates);

        // random - yes
        $this->services->random->setRolls([
            new TestRoll('Has Sea', 3, 1, 100),
            new TestRoll('Has River', 3, 1, 100),
            new TestRoll('Has Military', 3, 1, 100),
            new TestRoll('Has Walls', 7, 1, 100),
            new TestRoll('Num Gates', 4, 1, 4),
        ]);
        $postData->hasGates = BooleanRandom::RANDOM;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, $city->numGates);

        // random - no
        $this->services->random->setRolls([
            new TestRoll('Has Sea', 3, 1, 100),
            new TestRoll('Has River', 3, 1, 100),
            new TestRoll('Has Military', 3, 1, 100),
            new TestRoll('Has Walls', 73, 1, 100),
        ]);
        $postData->hasGates = BooleanRandom::RANDOM;

        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(0, $city->numGates);
    }
}
