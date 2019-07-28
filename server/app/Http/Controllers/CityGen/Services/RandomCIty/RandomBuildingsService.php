<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\City\CityBuilding;
use App\Http\Controllers\CityGen\Models\City\CityWard;

class RandomBuildingsService extends BaseService
{
    /**
     * @param City $city
     * @param CityWard $ward
     * @param int[]|null $buildingWeights
     */
    public function generateBuildings($city, $ward, $buildingWeights)
    {
        // determine how many buildings per acre
        $acresDensity = Table::getTable(Table::POPULATION_WARD_DENSITY)->getTable()[$city->populationType][$ward->type];
        $wardDensityAcres = max(1, $acresDensity * $ward->acres);

        // use given weights or from the buildings table
        $buildingWeightsUse = $buildingWeights ? $buildingWeights : Table::getTable(Table::BUILDINGS)->getTable()[$ward->type];
        $tableBuildingSubtypes = Table::getTable(Table::BUILDINGS_SUBTYPES)->getTable();

        // add buildings to fill densityAcres
        for ($i = 1; $i <= $wardDensityAcres; $i++) {
            $tableBuilding = $this->services->table->getTableResultRangeCustom('Building Weight', $buildingWeightsUse);
            $quality = $this->services->random->randMinMaxInt('Building Quality', $tableBuilding->qualityMinMax);

            if (isset($tableBuildingSubtypes[$tableBuilding->building])) {
                $subType = $this->services->table->getTableResultRangeCustom('Building SubType', $tableBuildingSubtypes[$tableBuilding->building]);
            } else {
                $subType = null;
            }
            $ward->buildings[] = new CityBuilding($tableBuilding->building, $subType, $quality);
        }

        // sort by name
        usort($ward->buildings, function ($a, $b) {
            return strcmp($a->building, $b->building);
        });
    }
}
