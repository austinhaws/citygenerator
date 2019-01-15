<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Models\City;
use App\Http\Controllers\CityGen\Models\PostData;
use App\Http\Controllers\CityGen\Services\BaseService;

class RandomCityPopulationService extends BaseService
{

    /**
     * randomize or set population and side effects
     *
     * @param City $city
     * @param PostData $postData
     */
    public function determinePopulation(City $city, PostData $postData) {
        // population type
        $populationType = $postData->populationType;
        if ($this->services->randomService->isRandom($populationType)) {
            $city->populationType = $this->services->tableService->getTableResultRandom(Table::POPULATION_TYPE);
        } else {
            $this->useEnteredPopulationType($city, $populationType);
        }

        // population size: if hand entered, may already be set
        if ($city->populationSize === false) {
            $value = $this->services->tableService->getTableResultIndex(Table::POPULATION_SIZE, $city->populationType);
            $city->populationSize = $this->services->randomService->randRange("Random Population Size", $value[MinMax::MIN], $value[MinMax::MAX]);
        }
    }

    /**
     * user picked a population type or an actual #. if a number then determine what size of city is good for that number
     *
     * @param City $city
     * @param string $populationType
     */
    private function useEnteredPopulationType(City $city, string $populationType) {
        switch ($populationType) {
            case PopulationType::THORP:
            case PopulationType::HAMLET:
            case PopulationType::VILLAGE:
            case PopulationType::SMALL_TOWN:
            case PopulationType::LARGE_TOWN:
            case PopulationType::SMALL_CITY:
            case PopulationType::LARGE_CITY:
            case PopulationType::METROPOLIS:
                $city->populationType = $populationType;
                break;
            default:
                // they hand entered a value
                $entered_value = intval($populationType, 10);

                // check for bounds
                $populationSizeTable = Table::getTable(Table::POPULATION_SIZE)->getTable();
                $city->populationType = false;
                if ($entered_value < $populationSizeTable[PopulationType::THORP][MinMax::MIN]) {
                    $entered_value = $populationSizeTable[PopulationType::THORP][MinMax::MIN];
                    $city->populationType = PopulationType::THORP;
                } else if ($entered_value > $populationSizeTable[PopulationType::METROPOLIS][MinMax::MAX]) {
                    // hand entered a very large value, so make it a metropolis
                    $city->populationType = PopulationType::METROPOLIS;
                }

                // if population type not yet set, determine what it should be
                if (!$city->populationType) {
                    $city->populationType = $this->services->tableService->getTableKeyFromRangeValue(Table::POPULATION_SIZE, $entered_value);
                }

                $city->populationSize = $entered_value;
                break;
        }
    }

}
