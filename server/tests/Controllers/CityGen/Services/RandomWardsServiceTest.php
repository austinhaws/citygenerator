<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Common\Models\MinMax;
use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Constants\Building;
use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Constants\Ward;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Models\Post\WardAdded;
use App\Http\Controllers\CityGen\Models\Table\TableBuilding;
use App\Http\Controllers\CityGen\Util\TestRoll;
use App\Http\Controllers\CityGen\Util\TestRollGroup;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class RandomWardsServiceTest extends BaseTestCase
{
    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testDetermineWards()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded([], Ward::SLUM),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // Slum / Market / Merchant
        $this->assertSame(3, count($city->wards));
        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SLUM;
        })), 'Has sea ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testNumGates()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 2;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
            new TestRoll('Ward acres used', 450, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // 2 gates / market / merchant
        $this->assertSame(4, count($city->wards));
        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::GATE;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testHasSeaNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::TRUE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));
        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SEA && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testHasSeaNotAlreadyDoneWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::TRUE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
            new TestRoll('Ward acres used', 450, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));
        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SEA;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testHasSeaAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::TRUE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::SEA),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SEA;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testHasRiverNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::TRUE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));
        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::RIVER;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testHasRiverAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::TRUE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::RIVER),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::RIVER;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testHasMilitaryNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::TRUE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));
        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MILITARY && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testHasMilitaryAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::TRUE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::MILITARY),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MILITARY && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testHasMilitaryInsideWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::TRUE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::MILITARY),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
            new TestRoll('Ward acres used', 450, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MILITARY && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testAdministrationSmallTownAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_TOWN;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::ADMINISTRATION),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 200, 700),
            new TestRoll('Ward acres used', 250, 200, 700),
            new TestRoll('Ward acres used', 350, 200, 700),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testAdministrationSmallTownNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_TOWN;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 200, 700),
            new TestRoll('Ward acres used', 250, 200, 700),
            new TestRoll('Ward acres used', 350, 200, 700),
            new TestRoll('Ward acres used', 450, 200, 700),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testAdministrationSmallerThanSmallTownAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::ADMINISTRATION),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 200, 500),
            new TestRoll('Ward acres used', 250, 200, 500),
            new TestRoll('Ward acres used', 350, 200, 500),
            new TestRoll('Ward acres used', 450, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testAdministrationSmallerThanSmallTownNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 200, 500),
            new TestRoll('Ward acres used', 250, 200, 500),
            new TestRoll('Ward acres used', 350, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testAdministrationLargerThanSmallTownAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_TOWN;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::ADMINISTRATION),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 300, 900),
            new TestRoll('Ward acres used', 250, 300, 900),
            new TestRoll('Ward acres used', 350, 300, 900),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testAdministrationLargerThanSmallTownNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_TOWN;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 300, 900),
            new TestRoll('Ward acres used', 250, 300, 900),
            new TestRoll('Ward acres used', 350, 300, 900),
            new TestRoll('Ward acres used', 450, 300, 900),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testCraftsmenSmallCityAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::CRAFTSMEN),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 400, 1100),
            new TestRoll('Ward acres used', 250, 400, 1100),
            new TestRoll('Ward acres used', 350, 400, 1100),
            new TestRoll('Ward acres used', 450, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testCraftsmenSmallCityNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 400, 1100),
            new TestRoll('Ward acres used', 250, 400, 1100),
            new TestRoll('Ward acres used', 350, 400, 1100),
            new TestRoll('Ward acres used', 450, 400, 1100),
            new TestRoll('Ward acres used', 550, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(5, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testCraftsmenSmallerThanSmallCityAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::CRAFTSMEN),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 200, 500),
            new TestRoll('Ward acres used', 250, 200, 500),
            new TestRoll('Ward acres used', 350, 200, 500),
            new TestRoll('Ward acres used', 450, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testCraftsmenSmallerThanSmallCityNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 200, 500),
            new TestRoll('Ward acres used', 250, 200, 500),
            new TestRoll('Ward acres used', 350, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(3, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testCraftsmenLargerThanSmallCityAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::CRAFTSMEN),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 500, 1300),
            new TestRoll('Ward acres used', 250, 500, 1300),
            new TestRoll('Ward acres used', 350, 500, 1300),
            new TestRoll('Ward acres used', 450, 500, 1300),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testCraftsmenLargerThanSmallCityNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 500, 1300),
            new TestRoll('Ward acres used', 250, 500, 1300),
            new TestRoll('Ward acres used', 350, 500, 1300),
            new TestRoll('Ward acres used', 450, 500, 1300),
            new TestRoll('Ward acres used', 550, 500, 1300),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(5, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testMarketAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::MARKET),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(2, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MARKET && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testMerchantAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::MERCHANT),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(2, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MARKET && $ward->insideWalls;
        })), 'Has tested ward');
    }


    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testPatriciateMetropolisMetropolisMetropolisMetropolisAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::METROPOLIS;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::PATRICIATE),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 600, 1500),
            new TestRoll('Ward acres used', 250, 600, 1500),
            new TestRoll('Ward acres used', 350, 600, 1500),
            new TestRoll('Ward acres used', 450, 600, 1500),
            new TestRoll('Ward acres used', 550, 600, 1500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(5, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::PATRICIATE && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testPatriciateMetropolisNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::METROPOLIS;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 600, 1500),
            new TestRoll('Ward acres used', 250, 600, 1500),
            new TestRoll('Ward acres used', 350, 600, 1500),
            new TestRoll('Ward acres used', 450, 600, 1500),
            new TestRoll('Ward acres used', 550, 600, 1500),
            new TestRoll('Ward acres used', 650, 600, 1500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(6, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::PATRICIATE && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testPatriciateSmallerThanMetropolisAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::PATRICIATE),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 500, 1300),
            new TestRoll('Ward acres used', 250, 500, 1300),
            new TestRoll('Ward acres used', 350, 500, 1300),
            new TestRoll('Ward acres used', 450, 500, 1300),
            new TestRoll('Ward acres used', 550, 500, 1300),
            new TestRoll('Ward acres used', 650, 500, 1300),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(6, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::PATRICIATE && $ward->insideWalls;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testPatriciateSmallerThanMetropolisNotAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 500, 1300),
            new TestRoll('Ward acres used', 250, 500, 1300),
            new TestRoll('Ward acres used', 350, 500, 1300),
            new TestRoll('Ward acres used', 450, 500, 1300),
            new TestRoll('Ward acres used', 550, 500, 1300),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(5, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::PATRICIATE;
        })), 'Has tested ward');
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomWardsService::determineWards
     */
    public function testGateAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 1;
        $city->acres = 1;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::GATE),
            new WardAdded(null, Ward::GATE),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 150, 100, 200),
            new TestRoll('Ward acres used', 250, 100, 200),
            new TestRoll('Ward acres used', 350, 100, 200),
            new TestRoll('Ward acres used', 450, 100, 200),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // sea/market/merchant
        $this->assertSame(4, count($city->wards));

        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::GATE;
        })), 'Has tested ward');
    }

    public function testRandomWardPatriciateSmallCity()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 17;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 1, 1, 100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 70, 1, 100),
            new TestRoll('Ward acres used', 1100, 400, 1100),
            new TestRoll('Ward Type', 70, 1, 100),
            new TestRoll('Ward acres used', 1100, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(7, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::PATRICIATE && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    // only one patriciate
    public function testRandomWardPatriciateSmallCityAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 21;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::PATRICIATE),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 1, 1, 100),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Odoriferous inside walls?', 25, 1, 100),
            new TestRoll('Ward acres used', 11000, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(6, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::PATRICIATE && $ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomWardPatriciateSmallerThanSmallCity()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 3;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(2, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::PATRICIATE;
        })), 'Has tested ward');
    }

    public function testRandomWardAdministrationSmallCity()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 17;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 11, 1, 100),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 11000, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(5, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    // only one patriciate
    public function testRandomWardAdministrationSmallCityAlreadyDone()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 21;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::ADMINISTRATION),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 11, 1, 100),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Odoriferous inside walls?', 25, 1, 100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Odoriferous inside walls?', 25, 1, 100),
            new TestRoll('Ward acres used', 11000, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(6, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION && $ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomWardAdministrationSmallerThanSmallCity()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 3;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(2, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ADMINISTRATION;
        })), 'Has tested ward');
    }

    public function testRandomSea()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::TRUE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 7;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::SEA),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 13, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, count($city->wards));

        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SEA;
        })), 'Has tested ward');
    }

    public function testRandomSeaNoSea()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 7;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 13, 1, 100),
            new TestRoll('Ward Type', 13, 1, 100),
            new TestRoll('Ward Type', 13, 1, 100),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SEA;
        })), 'Has tested ward');
    }

    public function testRandomRiver()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::TRUE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 7;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::RIVER),
        ];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 16, 1, 100),
            new TestRoll('River inside walls?', 1, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, count($city->wards));

        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::RIVER;
        })), 'Has tested ward');
    }

    public function testRandomRiverNoRiver()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 7;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 16, 1, 100),
            new TestRoll('Ward Type', 16, 1, 100),
            new TestRoll('Ward Type', 16, 1, 100),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::RIVER;
        })), 'Has tested ward');
    }

    public function testRandomOdoriferousInsideWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 8;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Odoriferous inside walls?', 1, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Odoriferous inside walls?', 100, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ODORIFEROUS && $ward->insideWalls;
        })), 'Has tested ward');
        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ODORIFEROUS && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomOdoriferousNoGates()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 8;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 200, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, count($city->wards));

        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::ODORIFEROUS && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomShantySmallCity()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 20;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 30, 1, 100),
            new TestRoll('Ward acres used', 11000, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(5, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SHANTY && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomShantySmallerSmallCity()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 8;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 200, 500),
            new TestRoll('Ward acres used', 100, 200, 500),
            new TestRoll('Ward Type', 30, 1, 100),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 100, 200, 500),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 11000, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SHANTY;
        })), 'Has tested ward');
    }

    public function testRandomSlumSmallCityWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 20;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 40, 1, 100),
            new TestRoll('Ward acres used', 11000, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(5, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SLUM && $ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomSlumSmallCityNoWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::SMALL_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 20;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward acres used', 100, 400, 1100),
            new TestRoll('Ward Type', 40, 1, 100),
            new TestRoll('Ward acres used', 11000, 400, 1100),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(5, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SLUM && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomSlumSmallerSmallCity()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 8;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 200, 500),
            new TestRoll('Ward acres used', 100, 200, 500),
            new TestRoll('Ward Type', 40, 1, 100),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 100, 200, 500),
            new TestRoll('Ward Type', 25, 1, 100),
            new TestRoll('Ward acres used', 11000, 200, 500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(4, count($city->wards));

        $this->assertSame(0, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::SLUM;
        })), 'Has tested ward');
    }

    public function testRandomMerchantSmallCityWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::METROPOLIS;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 35;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward Type', 55, 1, 100),
            new TestRoll('Ward acres used', 11000, 600, 1500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(6, count($city->wards));

        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MERCHANT && $ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomMerchantSmallNoCityWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::METROPOLIS;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 35;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward Type', 55, 1, 100),
            new TestRoll('Ward acres used', 11000, 600, 1500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(6, count($city->wards));

        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MERCHANT && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomMerchantSmallerMetropolis()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 25;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward Type', 55, 1, 100),
            new TestRoll('Ward Type', 40, 1, 100),
            new TestRoll('Ward acres used', 11000, 500, 1300),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(5, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MERCHANT && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomMarketWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 26;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::TRUE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Market inside walls?', 100, 1, 100),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Market inside walls?', 1, 1, 100),
            new TestRoll('Ward acres used', 11000, 500, 1300),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(6, count($city->wards));

        $this->assertSame(1, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MARKET && !$ward->insideWalls;
        })), 'Has tested ward');
        // the auto added market and the random one
        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MARKET && $ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomMarketNoWalls()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_CITY;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 26;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Ward acres used', 100, 500, 1300),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Ward acres used', 11000, 500, 1300),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(6, count($city->wards));

        $this->assertSame(3, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::MARKET && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomCraftsmenLargeTownAlready2()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_TOWN;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 20;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::CRAFTSMEN),
            new WardAdded(null, Ward::CRAFTSMEN),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward Type', 76, 1, 100),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Ward acres used', 11000, 300, 900),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(7, count($city->wards));

        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomCraftsmenLargeTownAlready1()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_TOWN;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 20;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::CRAFTSMEN),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward Type', 76, 1, 100),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward Type', 76, 1, 100),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Ward acres used', 100, 300, 900),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Ward acres used', 11000, 300, 900),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(7, count($city->wards));

        $this->assertSame(2, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomCraftsmenMetropolis()
    {
        $city = new City();
        $city->populationType = PopulationType::METROPOLIS;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = 60;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded(null, Ward::CRAFTSMEN),
            new WardAdded(null, Ward::CRAFTSMEN),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::FALSE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward Type', 76, 1, 100),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward Type', 76, 1, 100),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Ward acres used', 100, 600, 1500),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Ward acres used', 11000, 600, 1500),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(10, count($city->wards));

        $this->assertSame(4, count(array_filter($city->wards, function ($ward) {
            return $ward->type === Ward::CRAFTSMEN && !$ward->insideWalls;
        })), 'Has tested ward');
    }

    public function testRandomCustomWardBuildings()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->hasSea = BooleanRandom::FALSE;
        $city->hasRiver = BooleanRandom::FALSE;
        $city->hasMilitary = BooleanRandom::FALSE;
        $city->numGates = 0;
        $city->acres = .25;

        // true
        $postData = new PostData();
        $postData->wardsAdded = [
            new WardAdded([
                new TableBuilding(Building::HOUSE, new MinMax(1, 2)),
                new TableBuilding(Building::WAREHOUSE, new MinMax(1, 2)),
            ], Ward::CRAFTSMEN),
        ];
        $postData->hasGates = BooleanRandom::FALSE;
        $postData->generateBuildings = BooleanRandom::TRUE;

        $this->services->random->setRolls([
            new TestRoll('Ward acres used', 200, 100, 200),
            new TestRoll('Building Weight', 1, 0, 1),
            new TestRoll('Building Quality', 2, 1, 2),
            new TestRoll('Building Weight', 0, 0, 1),
            new TestRoll('Building Quality', 1, 1, 2),
            new TestRoll('Building Weight', 1, 0, 1),
            new TestRoll('Building Quality', 2, 1, 2),
            new TestRoll('Building Weight', 0, 0, 1),
            new TestRoll('Building Quality', 1, 1, 2),
            new TestRoll('Ward acres used', 100, 100, 200),

            new TestRoll('Building Weight', 100, 1, 100),
            new TestRoll('Building Quality', 3, 1, 3),
            new TestRoll('Building Weight', 100, 1, 100),
            new TestRoll('Building Quality', 3, 1, 3),
            new TestRoll('Building Weight', 50, 1, 100),
            new TestRoll('Building Quality', 2, 1, 2),
            new TestRoll('Ward acres used', 100, 100, 200),
            new TestRoll('Building Weight', 100, 1, 100),
            new TestRoll('Building Quality', 1, 1, 2),
        ]);

        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(3, count($city->wards));

        $this->assertSame(Ward::CRAFTSMEN, $city->wards[0]->type);
        $this->assertSame(Ward::MARKET, $city->wards[1]->type);
        $this->assertSame(Ward::MERCHANT, $city->wards[2]->type);

        $this->assertSame(4, count($city->wards[0]->buildings));

        $this->assertSame(0, count(array_filter($city->wards[0]->buildings, function ($building) {
            return $building === Building::HOUSE || $building === Building::WAREHOUSE;
        })), 'only expected buildings');
    }

    public function testMaxWardsThorp() {
        $postData = new PostData();
        $postData->populationType = PopulationType::THORP;
        $postData->wardsAdded = [];
        $postData->generateBuildings = BooleanRandom::FALSE;

        $city = new City();
        $city->populationType = PopulationType::THORP;

        $this->services->random->setRolls([
            new TestRoll('Random Population Size', 80, 20, 80),
            new TestRoll('randomAcres', 1),
            new TestRoll('Ward acres used', 100, 100, 200),
            new TestRoll('Ward acres used', 100, 100, 200),
        ]);

        $this->services->randomCityPopulation->determinePopulation($city, $postData);
        $this->services->randomAcresStructures->randomAcres($city);
        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(2, count($city->wards));
    }

    public function testMaxWardsVillage() {
        $postData = new PostData();
        $postData->populationType = PopulationType::VILLAGE;
        $postData->wardsAdded = [];
        $postData->generateBuildings = BooleanRandom::FALSE;

        $city = new City();
        $city->populationType = PopulationType::THORP;

        $this->services->random->setRolls([
            new TestRoll('Random Population Size', 900, 401, 900),
            new TestRoll('randomAcres', 1),
            new TestRoll('Ward acres used', 100, 200, 500),
            new TestRoll('Ward acres used', 100, 200, 500),
            new TestRollGroup('Ward Markets', [
                new TestRoll('Ward Type', 75, 1, 100),
                new TestRoll('Ward acres used', 100, 200, 500),
            ], 6),
        ]);

        $this->services->randomCityPopulation->determinePopulation($city, $postData);
        $this->services->randomAcresStructures->randomAcres($city);
        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(8, count($city->wards));
    }

    public function testMaxWardsMetropolis() {
        $postData = new PostData();
        $postData->populationType = PopulationType::METROPOLIS;
        $postData->wardsAdded = [];
        $postData->generateBuildings = BooleanRandom::FALSE;
        $postData->professions = BooleanRandom::FALSE;

        $city = new City();
        $city->populationType = PopulationType::THORP;

        $this->services->random->setRolls([
            new TestRoll('Random Population Size', 90000, 32001, 90000),
            new TestRoll('randomAcres', 1),
            new TestRollGroup('Preset wards', [
                new TestRoll('Ward acres used', 600, 600, 1500),
            ], 5),
            new TestRollGroup('Ward Markets', [
                new TestRoll('Ward Type', 75, 1, 100),
                new TestRoll('Ward acres used', 600, 600, 1500),
            ], 95),
        ]);

        $this->services->randomCityPopulation->determinePopulation($city, $postData);
        $this->services->randomAcresStructures->randomAcres($city);
        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // unlimited, used "null" in max wards table
        $this->assertSame(100, count($city->wards));
        foreach ($city->wards as $ward) {
            $this->assertSame(0, count($ward->buildings));
        }
    }

    public function testWardsAlwaysGetBuildings()
    {
        $postData = new PostData();
        $postData->populationType = PopulationType::THORP;
        $postData->wardsAdded = [];
        $postData->generateBuildings = BooleanRandom::TRUE;

        $city = new City();
        $city->populationType = PopulationType::THORP;

        $this->services->random->setRolls([
            new TestRoll('Random Population Size', 20, 20, 80),
            new TestRoll('randomAcres', 1),
            new TestRoll('Ward acres used', 100, 100, 200),
            new TestRollGroup('buildings', [
                new TestRoll('Building Weight', 1, 1, 100),
                new TestRoll('Building Quality', 2, 2, 3),
            ], 3),
            new TestRoll('Ward acres used', 100, 100, 200),
            new TestRollGroup('buildings', [
                new TestRoll('Building Weight', 1, 1, 100),
                new TestRoll('Building Quality', 2, 1, 3),
            ], 1),
        ]);

        $this->services->randomCityPopulation->determinePopulation($city, $postData);
        $this->services->randomAcresStructures->randomAcres($city);
        $this->services->randomWards->determineWards($city, $postData);

        $this->services->random->verifyRolls();

        // unlimited, used "null" in max wards table
        $this->assertSame(2, count($city->wards));
        $this->assertNotSame(0, count($city->wards[0]->buildings));
        $this->assertNotSame(0, count($city->wards[1]->buildings));
    }
}
