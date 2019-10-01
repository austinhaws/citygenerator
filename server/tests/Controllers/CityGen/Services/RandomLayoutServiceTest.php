<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutCell;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutMap;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Util\TestRoll;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class RandomLayoutServiceTest extends BaseTestCase
{
    public function testGenerateLayout()
    {
        $city = $this->knownCity();

        $this->services->random->setRolls([
            new TestRoll('Layout: Height/Width ratio', 52, 45, 55),
            new TestRoll('Layout: Pick Starting Point', 29, 0, 29),
            new TestRoll('Layout: Pick Starting Point', 3, 0, 5),
            new TestRoll('Layout: Pick Starting Point', 0, 0, 4),
            new TestRoll('Layout: Pick Starting Point', 2, 0, 3),
            new TestRoll('Layout: Pick Starting Point', 2, 0, 2),
            new TestRoll('Layout: Pick Starting Point', 0, 0, 1),
            new TestRoll('Layout: Starting Ring', 1, 0, 2),
            new TestRoll('Layout: Pick Starting Point', 20, 0, 21),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 6),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 5),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 4),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 3),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
            new TestRoll('Layout: Pick Point', 0, 0, 2),
            new TestRoll('Layout: Pick Point', 0, 0, 1),
        ]);
        $this->services->randomLayout->generateLayout($city, new PostData());

        $this->services->random->verifyRolls();

        $this->assertSame(9, count($city->layout->cells));
        $this->assertSame(8, count($city->layout->cells[0]));
        // all layout cells should have inside/outside walls set to true/false and not null
        array_walk($city->layout->cells, function ($cellRow) {
            array_walk($cellRow, function ($cell) {
                $this->assertNotNull($cell->insideWalls);
            });
        });
    }

    /**
     * @return City
     */
    private function knownCity()
    {
        $postData = new PostData();
        $postData->populationType = PopulationType::SMALL_CITY;
        $postData->generateLayout = BooleanRandom::FALSE;

        $this->services->random->setRolls($this->rollsForKnownCity());
        return $this->services->randomCity->randomizeCity($postData);
    }

    private function rollsForKnownCity()
    {
        return [
            new TestRoll('Random Population Size', 6025, 5001, 12000),
            new TestRoll('randomAcres', 1224687798, null, null),
            new TestRoll('randomNumStructures', 526481595, null, null),
            new TestRoll('Has Sea', 1, 1, 100),
            new TestRoll('Has River', 27, 1, 100),
            new TestRoll('Has Military', 29, 1, 100),
            new TestRoll('Has Walls', 14, 1, 100),
            new TestRoll('Num Gates', 1, 1, 4),
            new TestRoll('Ward acres used', 1007, 400, 1100),
            new TestRoll('Sea inside walls', 87, 1, 100),
            new TestRoll('Ward acres used', 706, 400, 1100),
            new TestRoll('River inside walls', 5, 1, 100),
            new TestRoll('Ward acres used', 583, 400, 1100),
            new TestRoll('Ward acres used', 503, 400, 1100),
            new TestRoll('Ward acres used', 1054, 400, 1100),
            new TestRoll('Ward acres used', 919, 400, 1100),
            new TestRoll('Ward acres used', 785, 400, 1100),
            new TestRoll('Ward Type', 75, 1, 100),
            new TestRoll('Market inside walls?', 42, 1, 100),
            new TestRoll('Ward acres used', 639, 400, 1100),
            new TestRoll('Random True/False', 45, 1, 100),
            new TestRoll('Power Level', 4, 3, 6),
            new TestRoll('Influence points', 1931, 1807, 2209),
            new TestRoll('PowerCenterTypeTable: range', 461, 1, 1000),
            new TestRoll('Influence', 376, 325, 398),
            new TestRoll('PowerCenterAlignmentTable: range', 60, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 661, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 8, 1, 20),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 214, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 5, 1, 13),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 417, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 11, 1, 20),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 289, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 15),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 162, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 7, 1, 13),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 391, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 13, 1, 20),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 878, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 5, 1, 11),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 900, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 17),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 207, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 8, 1, 12),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('PowerCenterTypeTable: range', 500, 1, 1000),
            new TestRoll('Influence', 325, 325, 398),
            new TestRoll('PowerCenterAlignmentTable: range', 96, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 135, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 11, 1, 12),
            new TestRoll('NPC Level Increase', 5, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 524, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 20, 1, 20),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 859, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 11, 1, 12),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 713, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 9, 1, 20),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 292, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 6, 1, 15),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 5, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 920, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 13, 1, 17),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 5, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 373, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 20),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('PowerCenterTypeTable: range', 864, 1, 1000),
            new TestRoll('Influence', 336, 325, 398),
            new TestRoll('PowerCenterAlignmentTable: range', 28, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 526, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 2, 1, 20),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 347, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 15, 1, 15),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 344, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 10, 1, 14),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 240, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 3, 1, 12),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 5, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 170, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 1, 1, 13),
            new TestRoll('NPCClassRandomClassTable: range', 455, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 13, 1, 20),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 784, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 13, 1, 16),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 685, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 9, 1, 14),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 588, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 17, 1, 20),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('PowerCenterTypeTable: range', 752, 1, 1000),
            new TestRoll('PowerCenterAlignmentTable: range', 33, 1, 100),
            new TestRoll('NPCClassRandomClassTable: range', 960, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 2, 1, 17),
            new TestRoll('NPC Level Increase', 5, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 515, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 15, 1, 20),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 943, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 9, 1, 17),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 13, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 9, 1, 16),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPC Level Increase', 6, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 5, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 611, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 18, 1, 20),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 8, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 268, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 12, 1, 13),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 4, 1, 10),
            new TestRoll('NPC Level Increase', 2, 1, 10),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 187, 1, 1000),
            new TestRoll('NPC level bonus', 1, 0, 1),
            new TestRoll('NPC level', 1, 1, 13),
            new TestRoll('NPCClassRandomClassTable: range', 861, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 3, 1, 11),
            new TestRoll('NPC Level Increase', 3, 1, 10),
            new TestRoll('NPC Level Increase', 10, 1, 10),
            new TestRoll('NPCClassRandomClassTable: range', 315, 1, 1000),
            new TestRoll('NPC level bonus', 0, 0, 1),
            new TestRoll('NPC level', 14, 1, 14),
            new TestRoll('NPC Level Increase', 9, 1, 10),
            new TestRoll('NPC Level Increase', 1, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('NPC Level Increase', 5, 1, 10),
            new TestRoll('NPC Level Increase', 7, 1, 10),
            new TestRoll('Racial Mix', 2, 1, 3),
            new TestRoll('RacesRandomTable: range', 96, 1, 100),
            new TestRoll('Resident Race ratio range', 1169, 0, 4759),
            new TestRoll('Resident Race ratio range', 18, 0, 542),
            new TestRoll('Resident Race ratio range', 171, 0, 301),
            new TestRoll('Resident Race ratio range', 109, 0, 180),
            new TestRoll('Resident Race ratio range', 95, 0, 120),
            new TestRoll('Resident Race ratio range', 45, 0, 60),
            new TestRoll('Resident Race ratio range', 5, 0, 60),
            new TestRoll('Resident Race ratio range', 14, 0, 60),
            new TestRoll('Guild Modifier', 0, 0, 5),
            new TestRoll('Number Exports', 3, 2, 4),
            new TestRoll('CommoditiesTable: range', 1824, 1, 3700),
            new TestRoll('CommoditiesTable: range', 435, 1, 3700),
            new TestRoll('CommoditiesTable: range', 2191, 1, 3700),
            new TestRoll('Number Imports', 3, 2, 4),
            new TestRoll('CommoditiesTable: range', 515, 1, 3700),
            new TestRoll('CommoditiesTable: range', 2001, 1, 3700),
            new TestRoll('CommoditiesTable: range', 113, 1, 3700),
            new TestRoll('Number Famous', 4, 2, 4),
            new TestRoll('FamousTable: range', 1915, 1, 4250),
            new TestRoll('FamousTable: range', 3400, 1, 4250),
            new TestRoll('FamousTable: range', 453, 1, 4250),
            new TestRoll('FamousTable: range', 345, 1, 4250),
            new TestRoll('Number Infamous', 3, 2, 4),
            new TestRoll('FamousTable: range', 2426, 1, 4250),
            new TestRoll('FamousTable: range', 2237, 1, 4250),
            new TestRoll('FamousTable: range', 2251, 1, 4250),
            new TestRoll('FamousTable: range', 1135, 1, 4250),
            new TestRoll('Name: half orc', 70, 1, 100),
            new TestRoll('NameNumWordsTable: range', 24, 1, 100),
            new TestRoll('NameNumSyllablesTable: range', 16, 1, 55),
            new TestRoll('SyllablesTable: range', 135, 1, 650),
            new TestRoll('SyllablesTable: range', 135, 1, 650),
        ];
    }

    public function testBunchOfRandoms()
    {
        $postData = new PostData();
        $postData->populationType = PopulationType::SMALL_CITY;
        $postData->generateLayout = BooleanRandom::TRUE;

        $this->services->random->setRolls([TestRoll::randomInstance()]);

        foreach(range(1, 10) as $_) {
            $city = $this->services->randomCity->randomizeCity($postData);
            $this->assertNotNull($city->layout);

            echo $this->showLayout($city);
        }
    }

    private function wardIdToSymbol($wardId)
    {
        if ($wardId === null) {
            $output = '◊';
        } else if ($wardId <= 26) {
            $output = chr(ord('a') + $wardId - 1);
        } else if ($wardId <= 52) {
            $output = chr(ord('A') + ($wardId - 26) - 1);
        } else if ($wardId == 62) {
            $output = chr(ord('0') + ($wardId - 52) - 1);
        } else {
            throw new \Exception('Too many wards: ' . $wardId);
        }
        return $output;
    }

    const FILLER = 'filler';
    const BLANK_WALL = 'blankWall';
    const HORIZONTAL_WALL = 'horizontalWall';
    const VERTICAL_WALL = 'verticalWall';
    const CROSS_WALL = 'crossWall';
    const DOWN_WALL = 'downWall';
    const RIGHT_WALL = 'rightWall';
    const LEFT_WALL = 'leftWall';
    const UP_WALL = 'upWall';
    const TOP_LEFT_WALL = 'topLeftWall';
    const TOP_RIGHT_WALL = 'topRightWall';
    const BOTTOM_LEFT_WALL = 'bottomLeftWall';
    const BOTTOM_RIGHT_WALL = 'bottomRightWall';
    private function showLayout(City $city)
    {
        echo join("\n", array_map(function ($ward) {
            $symbol = $this->wardIdToSymbol($ward->id);
            return "$ward->id($symbol): " . ($ward->insideWalls ? 'Walled' : 'no walls') . " - $ward->type";
        }, $city->wards));

        echo "\n";

        echo join("\n", array_map(function ($cellRow, $y) use ($city) {
            $keys = array_keys($cellRow);
            $consts = [
                self::FILLER => ' ',
                self::BLANK_WALL => ' ',
                self::HORIZONTAL_WALL => '─',
                self::VERTICAL_WALL => '│',
                self::CROSS_WALL => '┼',
                self::DOWN_WALL => '┬',
                self::RIGHT_WALL => '├',
                self::LEFT_WALL => '┤',
                self::UP_WALL => '┴',
                self::TOP_LEFT_WALL => '┌',
                self::TOP_RIGHT_WALL => '┐',
                self::BOTTOM_LEFT_WALL => '└',
                self::BOTTOM_RIGHT_WALL => '┘',
            ];

            $layers = [];
            if ($y === 0) {
                $layers[] = array_map(function ($cell, $x) use ($consts, $city, $y) {
                    $output = '';
                    if ($x === 0) {
                        $output .= $this->lineForCorner($x, $y, 1, $city, $consts);
                    }
                    $output .= $cell->walls[LayoutMap::DIRECTION_UP] ? $consts[self::HORIZONTAL_WALL] : $consts[self::BLANK_WALL];
                    $output .= $this->lineForCorner($x, $y, 2, $city, $consts);
                    return $output;
                }, $cellRow, $keys);
            }

            $layers[] = array_map(function ($cell, $x) use ($consts) {
                $output = '';
                if ($x === 0) {
                    $output .= $cell->walls[LayoutMap::DIRECTION_LEFT] ? $consts[self::VERTICAL_WALL] : $consts[self::BLANK_WALL];
                }
                $output .= $this->wardIdToSymbol($cell->wardId);
                $output .= $cell->walls[LayoutMap::DIRECTION_RIGHT] ? $consts[self::VERTICAL_WALL] : $consts[self::BLANK_WALL];
                return $output;
            }, $cellRow, $keys);

            $layers[] = array_map(function ($cell, $x) use ($consts, $y, $city) {
                $output = '';
                if ($x === 0) {
                    $output .= $this->lineForCorner($x, $y, 4, $city, $consts);
                }
                $output .= $cell->walls[LayoutMap::DIRECTION_DOWN] ? $consts[self::HORIZONTAL_WALL] : $consts[self::BLANK_WALL];
                $output .= $this->lineForCorner($x, $y, 3, $city, $consts);
                return $output;
            }, $cellRow, $keys);

            return join("\n", array_map(function ($layer) {
                return join('', $layer);
            }, $layers));
        }, $city->layout->cells, array_keys($city->layout->cells))) . "\n\n";
    }

    /**
     * @param int $x
     * @param int $y
     * @param City $city
     * @return LayoutCell[][]
     */
    private function cellNeighbors(int $x, int $y, City $city)
    {
        return [
            [
                $city->layout->getCell($x - 1, $y - 1),
                $city->layout->getCell($x, $y - 1),
                $city->layout->getCell($x + 1, $y - 1),
            ],
            [
                $city->layout->getCell($x - 1, $y),
                $city->layout->getCell($x, $y),
                $city->layout->getCell($x + 1, $y),
            ],
            [
                $city->layout->getCell($x - 1, $y + 1),
                $city->layout->getCell($x, $y + 1),
                $city->layout->getCell($x + 1, $y + 1),
            ],
        ];
    }

    private function wallStatusForCell($cell)
    {
        return $cell !== null && $cell->insideWalls;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $quadrant  [[1, 2], [3, 4]]
     * @param City $city
     * @param array $consts
     * @return mixed
     * @throws \Exception
     */
    private function lineForCorner(int $x, int $y, int $quadrant, City $city, array $consts)
    {
        // neighbors are a 3X3 matrix of layout cells around the current cell (null means it's past the border)
        $cellNeighbors = $this->cellNeighbors($x, $y, $city, $city);

        // quadrant tells what 2X2 group of the matrix is being analyzed to see what the corner connector should be
        switch ($quadrant) {
            case 1:
                $cellWallGroup = [
                    [$this->wallStatusForCell($cellNeighbors[0][0]), $this->wallStatusForCell($cellNeighbors[0][1])],
                    [$this->wallStatusForCell($cellNeighbors[1][0]), $this->wallStatusForCell($cellNeighbors[1][1])],
                ];
                break;
            case 2:
                $cellWallGroup = [
                    [$this->wallStatusForCell($cellNeighbors[0][1]), $this->wallStatusForCell($cellNeighbors[0][2])],
                    [$this->wallStatusForCell($cellNeighbors[1][1]), $this->wallStatusForCell($cellNeighbors[1][2])],
                ];
                break;
            case 3:
                $cellWallGroup = [
                    [$this->wallStatusForCell($cellNeighbors[1][1]), $this->wallStatusForCell($cellNeighbors[1][2])],
                    [$this->wallStatusForCell($cellNeighbors[2][1]), $this->wallStatusForCell($cellNeighbors[2][2])],
                ];
                break;
            case 4:
                $cellWallGroup = [
                    [$this->wallStatusForCell($cellNeighbors[1][0]), $this->wallStatusForCell($cellNeighbors[1][1])],
                    [$this->wallStatusForCell($cellNeighbors[2][0]), $this->wallStatusForCell($cellNeighbors[2][1])],
                ];
                break;
            default:
                throw new \Exception("Unknown quadrant: " . $quadrant);
        }

        $hasUp = $cellWallGroup[0][0] !== $cellWallGroup[0][1];
        $hasDown = $cellWallGroup[1][0] !== $cellWallGroup[1][1];
        $hasRight = $cellWallGroup[0][1] !== $cellWallGroup[1][1];
        $hasLeft = $cellWallGroup[0][0] !== $cellWallGroup[1][0];

        if ($hasUp && $hasDown && $hasLeft && $hasRight) {
            $piece = $consts[self::CROSS_WALL];
        } else if (!$hasUp && $hasDown && $hasLeft && $hasRight) {
            $piece = $consts[self::DOWN_WALL];
        } else if ($hasUp && $hasDown && !$hasLeft && $hasRight) {
            $piece = $consts[self::RIGHT_WALL];
        } else if ($hasUp && $hasDown && $hasLeft && !$hasRight) {
            $piece = $consts[self::LEFT_WALL];
        } else if ($hasUp && !$hasDown && $hasLeft && $hasRight) {
            $piece = $consts[self::UP_WALL];

        } else if ($hasUp && !$hasDown && $hasLeft && !$hasRight) {
            // '┘'
            $piece = $consts[self::BOTTOM_RIGHT_WALL];
        } else if (!$hasUp && $hasDown && $hasLeft && !$hasRight) {
            // '┐'
            $piece = $consts[self::TOP_RIGHT_WALL];
        } else if ($hasUp && !$hasDown && !$hasLeft && $hasRight) {
            // '└'
            $piece = $consts[self::BOTTOM_LEFT_WALL];
        } else if (!$hasUp && $hasDown && !$hasLeft && $hasRight) {
            // '┌'
            $piece = $consts[self::TOP_LEFT_WALL];

        } else if ($hasUp && $hasDown && !$hasLeft && !$hasRight) {
            $piece = $consts[self::VERTICAL_WALL];
        } else if (!$hasUp && !$hasDown && $hasLeft && $hasRight) {
            $piece = $consts[self::HORIZONTAL_WALL];
        } else if (!$hasUp && !$hasDown && !$hasLeft && !$hasRight) {
            $piece = $consts[self::BLANK_WALL];
        } else {
            throw new \Exception("Unknown wall status: $hasUp/$hasDown/$hasLeft/$hasRight");
        }

        return $piece;
    }
}
