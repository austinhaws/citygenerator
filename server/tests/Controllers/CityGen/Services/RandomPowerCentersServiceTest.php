<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Util\TestRoll;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class RandomPowerCentersServiceTest extends BaseTestCase
{
    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomPowerCentersService::determinePowerCenters
     */
    public function testDeterminePowerCentersNone()
    {
        $city = new City();
        $city->populationType = PopulationType::THORP;
        $city->wealth = 1000;

        // true
        $postData = new PostData();

        $this->services->random->setRolls([
            new TestRoll('Power Level', 0, 0, 1),
        ]);

        $this->services->randomPowerCenters->determinePowerCenters($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(0, $city->influencePointsUnabsorbed);
        $this->assertSame(0, count($city->powerCenters));
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomPowerCentersService::determinePowerCenters
     */
    public function testDeterminePowerCentersLots()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_TOWN;
        $city->wealth = 1000;

        // true
        $postData = new PostData();

        $this->services->random->setRolls([
            new TestRoll('Power Level', 3, 2, 5),
            new TestRoll('Influence points', 353, 188, 353),

            new TestRoll('PowerCenterTypeTable: range', 250, 1, 1000),
            new TestRoll('Influence', 84, 84, 103),
            new TestRoll('PowerCenterAlignmentTable: range', 10, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 999, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 9),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 700, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 7, 1, 11),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),

            new TestRoll('PowerCenterTypeTable: range', 750, 1, 1000),
            new TestRoll('Influence', 90, 84, 103),
            new TestRoll('PowerCenterAlignmentTable: range', 85, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 663, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 20, 1, 20),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 5, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 597, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 7, 1, 20),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),

            new TestRoll('PowerCenterTypeTable: range', 449, 1, 1000),
            new TestRoll('PowerCenterAlignmentTable: range', 62, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 478, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 7, 1, 20),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 222, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 10, 1, 9),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 222, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 10, 1, 9),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 222, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 10, 1, 9),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 222, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 10, 1, 9),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 222, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 10, 1, 9),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 222, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 10, 1, 9),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),

            new TestRoll('NPCClassRandomClassTable: range', 222, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 10, 1, 9),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
        ]);

        $this->services->randomPowerCenters->determinePowerCenters($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(70.60000000000001, $city->influencePointsUnabsorbed);
        $this->assertSame(3, count($city->powerCenters));

        // check sorting
        foreach ($city->powerCenters as $powerCenter) {
            $this->assertIsSorted($powerCenter->npcs, function ($npc) {
                return $npc->class;
            });
        }
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomPowerCentersService::determinePowerCenters
     */
    public function testUseRemainder()
    {
        $city = new City();
        $city->populationType = PopulationType::LARGE_TOWN;
        $city->wealth = 1000;

        // true
        $postData = new PostData();

        $this->services->random->setRolls([
            new TestRoll('Power Level', 1, 2, 5),
            new TestRoll('Influence points', 353, 188, 353),

            new TestRoll('PowerCenterTypeTable: range', 250, 1, 1000),
            new TestRoll('PowerCenterAlignmentTable: range', 10, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 999, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 9),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 1, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 13),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 1, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 13),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 1, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 13),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 1, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 13),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 1, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 13),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 1, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 13),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 1, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 13),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
        ]);

        $this->services->randomPowerCenters->determinePowerCenters($city, $postData);

        $this->services->random->verifyRolls();

        $this->assertSame(70.60000000000001, $city->influencePointsUnabsorbed);
        $this->assertSame(1, count($city->powerCenters));

        // check sorting
        foreach ($city->powerCenters as $powerCenter) {
            $this->assertIsSorted($powerCenter->npcs, function ($npc) {
                return $npc->class;
            });
        }
    }

    public function testPowerCenterNPCCounts() {
        // create power centers for a city
        $city = new City();
        $city->populationType = PopulationType::HAMLET;
        $city->wealth = 1000;
        $postData = new PostData();

        $this->services->random->setRolls([
            new TestRoll('Power Level', 2, 0, 2),
            new TestRoll('Influence points', 38, 31, 38),
            new TestRoll('PowerCenterTypeTable: range', 554, 1, 1000),
            new TestRoll('Influence', 19, 16, 19),
            new TestRoll('PowerCenterAlignmentTable: range', 1, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 191, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPCClassRandomClassTable: range', 331, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPCClassRandomClassTable: range', 446, 1, 1000),

            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 9, 1, 10),
            new TestRoll('NPC Level Increase', 5, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('PowerCenterTypeTable: range', 883, 1, 1000),
            new TestRoll('PowerCenterAlignmentTable: range', 95, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 755, 1, 1000),

            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 7, 1, 7),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 883, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPCClassRandomClassTable: range', 901, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 2, 1, 3),

            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 824, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPCClassRandomClassTable: range', 390, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 7, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
        ]);

        $this->services->randomPowerCenters->determinePowerCenters($city, $postData);

        $this->services->random->verifyRolls();

        // each power center should have different npc counts
        $this->assertEquals(2, count($city->powerCenters));
        $this->assertEquals(1, count($city->powerCenters[0]->npcs));
        $this->assertEquals(3, count($city->powerCenters[1]->npcs));

        // total npc count should be of all the power centers, not just one
        $totalNPCs = array_reduce($city->powerCenters, function ($result, $powerCenter) {
            return $result + array_reduce($powerCenter->npcs, function ($carry, $item) {
                return $carry + array_reduce($item->levels, function ($levelCarry, $level) {
                    return $levelCarry + $level->count;
                }, 0);
            }, 0);
        }, 0);
        $this->assertEquals(9 + 17, $totalNPCs);
        $this->assertEquals(9, $city->powerCenters[0]->npcsTotal);
        $this->assertEquals(17, $city->powerCenters[1]->npcsTotal);
    }
}
