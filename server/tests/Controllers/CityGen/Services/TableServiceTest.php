<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Util\TestRoll;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class TableServiceTest extends BaseTestCase
{
    public function testGetTableResultRange()
    {
        for ($x = 0; $x < 10; $x++) {
            $this->services->randomService->setRolls([new TestRoll('Random famous test', TestRoll::ANY, TestRoll::ANY, TestRoll::RANDOM)]);
            $this->assertTrue(!!$this->services->tableService->getTableResultRange(Table::FAMOUS, $this->services->randomService->randRange("Random famous test", 1, 4250)));
        }
    }

    public function testGetTableResultIndex()
    {
        $this->assertEquals(40, $this->services->tableService->getTableResultIndex(Table::POPULATION_WEALTH, PopulationType::THORP));
        $this->assertEquals(15000, $this->services->tableService->getTableResultIndex(Table::POPULATION_WEALTH, PopulationType::SMALL_CITY));

    }

    public function testGetTableResultRandom()
    {
        $this->services->randomService->setRolls([new TestRoll("getTableResultRandom-NameWordsTable", 0, 1140, 2)]);
        $this->assertEquals('autumn', $this->services->tableService->getTableResultRandom(Table::NAME_WORDS));
    }

    public function testGetTableKeyFromRangeValue()
    {
        $this->assertEquals(PopulationType::THORP, $this->services->tableService->getTableKeyFromRangeValue(Table::POPULATION_SIZE, 30));
        $this->assertEquals(PopulationType::METROPOLIS, $this->services->tableService->getTableKeyFromRangeValue(Table::POPULATION_SIZE, 90000));
        $this->assertEquals(false, $this->services->tableService->getTableKeyFromRangeValue(Table::POPULATION_SIZE, 90001));
        $this->assertEquals(false, $this->services->tableService->getTableKeyFromRangeValue(Table::POPULATION_SIZE, 10));

    }
}
