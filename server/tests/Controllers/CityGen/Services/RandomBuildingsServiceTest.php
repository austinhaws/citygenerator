<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Constants\Ward;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\City\CityWard;
use App\Http\Controllers\CityGen\Util\TestRoll;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class RandomBuildingsServiceTest extends BaseTestCase
{
    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomBuildingsService::generateBuildings
     */
    public function testDetermineWards()
    {
        $city = new City();
        $city->populationType = PopulationType::VILLAGE;

        $ward = new CityWard();
        $ward->type = Ward::MARKET;
        $ward->acres = 3.5;

        $this->services->random->setRolls(array_merge([
                new TestRoll('Building Weight', 50, 1, 100),
                new TestRoll('Building Quality', 2, 1, 2),

                new TestRoll('Building Weight', 56, 1, 100),
                new TestRoll('Building Quality', 1, 1, 2),
                new TestRoll('Building SubType', 25, 1, 1000)
            ],
            array_reduce(array_fill(0, 43, [
                new TestRoll('Building Weight', 50, 1, 100),
                new TestRoll('Building Quality', 2, 1, 2),
            ]), function ($carry, $a) {
                return array_merge($carry, $a);
            }, [])
        ));

        $this->services->randomBuildings->generateBuildings($city, $ward, null);

        $this->services->random->verifyRolls();

        $this->assertSame(45, count($ward->buildings));

        $this->assertIsSorted($ward->buildings, function ($item) {
            return $item->building;
        });
    }
}
