<?php

use App\Http\Controllers\CityGen\Constants\Building;
use App\Http\Controllers\CityGen\Util\TestRoll;
use App\Http\Controllers\CityGen\Util\TestRollGroup;
use Laravel\Lumen\Testing\TestCase;
use Test\Controllers\CityGen\Util\TestServicesService;

class CityGenControllerTest extends TestCase
{
    /** @var TestServicesService */
    protected $testServicesService;

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return Laravel\Lumen\Application
     */
    public function createApplication()
    {
        /** @var Laravel\Lumen\Application $app */
        $app = require __DIR__.'/../../../../../server/bootstrap/app.php';


        $this->testServicesService = new TestServicesService($this);
        $app->instance('App\Http\Common\Services\ServicesService', $this->testServicesService);

        return $app;
    }

    public function testGenerateWithCustomWards() {
        $data = array (
            'buildings' => 'custom',
            'name' => 'Random',
            'numGates' => '0',
            'military' => 'No',
            'populationType' => 'Thorp',
            'professions' => 'No',
            'race' => 'Human',
            'raceRatios' =>
                array (
                ),
            'racialMix' => 'Isolated',
            'river' => 'No',
            'sea' => 'No',
            'wardsAdded' =>
                array (
                    0 =>
                        array (
                            'ward' => 'Odoriferous',
                            'buildings' =>
                                array (
                                    0 =>
                                        array (
                                            'type' => 'Admin',
                                            'weight' => '0',
                                        ),
                                    1 =>
                                        array (
                                            'type' => 'Bath',
                                            'weight' => '0',
                                        ),
                                    2 =>
                                        array (
                                            'type' => 'Cemetery',
                                            'weight' => '0',
                                        ),
                                    3 =>
                                        array (
                                            'type' => 'Corral',
                                            'weight' => '0',
                                        ),
                                    4 =>
                                        array (
                                            'type' => 'Fountain',
                                            'weight' => '0',
                                        ),
                                    5 =>
                                        array (
                                            'type' => 'Hospital',
                                            'weight' => '0',
                                        ),
                                    6 =>
                                        array (
                                            'type' => 'House',
                                            'weight' => '0',
                                        ),
                                    7 =>
                                        array (
                                            'type' => 'Inn',
                                            'weight' => '0',
                                        ),
                                    8 =>
                                        array (
                                            'type' => 'Religious',
                                            'weight' => '0',
                                        ),
                                    9 =>
                                        array (
                                            'type' => 'Shop',
                                            'weight' => '0',
                                        ),
                                    10 =>
                                        array (
                                            'type' => 'Tavern',
                                            'weight' => '0',
                                        ),
                                    11 =>
                                        array (
                                            'type' => 'Tenement',
                                            'weight' => '0',
                                        ),
                                    12 =>
                                        array (
                                            'type' => 'Warehouse',
                                            'weight' => '0',
                                        ),
                                    13 =>
                                        array (
                                            'type' => 'Well',
                                            'weight' => '0',
                                        ),
                                    14 =>
                                        array (
                                            'type' => 'Workshop',
                                            'weight' => '1',
                                        ),
                                ),
                        ),
                ),
        );

        $this->testServicesService->random->setRolls([
            new TestRoll('Random Population Size', 1, 20, 80),
            new TestRoll('randomAcres', 1),
            new TestRoll('randomNumStructures', 1),
            new TestRoll('Has Walls', 100, 1, 100),

            new TestRoll('Ward acres used', 200, 100, 200),
            new TestRoll(TestRoll::ANY, TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->json('POST', 'citygenerator/generate', $data);

        $jsonResult = json_decode($this->response->getContent());
        if (!$jsonResult) {
            throw new Exception($this->response->getContent());
        }

        $this->testServicesService->random->verifyRolls();

        $this->assertSame(3, count($jsonResult->wards));

        // check ward buildings should all be workshops
        $this->assertSame(4, count($jsonResult->wards[0]->buildings));
        // all the buildings are workshops because of the added ward ratios
        $this->assertSame(4, count(array_filter($jsonResult->wards[0]->buildings, function ($building) {
            return $building->building === 'Workshop';
        })));
    }

    public function testGenerateWithCustomWardsMultiple() {
        $data = array (
            'buildings' => 'custom',
            'name' => 'Random',
            'numGates' => '0',
            'military' => 'No',
            'populationType' => 'Thorp',
            'professions' => 'No',
            'race' => 'Human',
            'raceRatios' =>
                array (
                ),
            'racialMix' => 'Isolated',
            'river' => 'No',
            'sea' => 'No',
            'wardsAdded' =>
                array (
                    0 =>
                        array (
                            'ward' => 'Odoriferous',
                            'buildings' =>
                                array (
                                    array (
                                        'type' => Building::TAVERN,
                                        'weight' => '3',
                                    ),
                                    array (
                                        'type' => Building::LIBRARY,
                                        'weight' => '4',
                                    ),
                                ),
                        ),
                ),
        );

        $this->testServicesService->random->setRolls([
            new TestRoll('Random Population Size', 1, 20, 80),
            new TestRoll('randomAcres', 1),
            new TestRoll('randomNumStructures', 1),
            new TestRoll('Has Walls', 100, 1, 100),
            new TestRollGroup('Building Generation A', [
                new TestRoll('Ward acres used', 200, 100, 200),
                new TestRollGroup('Building Generation Individuals', [
                    new TestRoll('Building Weight', TestRoll::RANDOM, 1, 7),
                    new TestRoll('Building Quality', TestRoll::RANDOM, 1, 4),
                ], 4),
            ], 1),

            new TestRoll('Ward acres used', TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY),
            new TestRoll(TestRoll::ANY, TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY, TestRoll::INFINITE),
        ]);

        $this->json('POST', 'citygenerator/generate', $data);

        $jsonResult = json_decode($this->response->getContent());
        if (!$jsonResult) {
            throw new Exception($this->response->getContent());
        }

        $this->testServicesService->random->verifyRolls();

        $this->assertSame(3, count($jsonResult->wards));

        // check ward buildings should all be workshops
        $this->assertSame(4, count($jsonResult->wards[0]->buildings));
        // all the buildings are workshops because of the added ward ratios
        $this->assertSame(4, count(array_filter($jsonResult->wards[0]->buildings, function ($building) {
            return $building->building === Building::LIBRARY || $building->building === Building::TAVERN;
        })));
    }
}
