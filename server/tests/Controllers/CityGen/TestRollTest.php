<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Util\TestRoll;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class TestRollTest extends BaseTestCase
{
    public function testRolls()
    {
        $this->services->randomService->setRolls([new TestRoll("testRolls", 3, 1, 4)]);

        $this->assertEquals(3, $this->services->randomService->randRangeInt("testRolls", 1, 4));
    }
}
