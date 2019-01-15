<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Models\City;
use App\Http\Controllers\CityGen\Services\BaseService;

class RandomCityPopulationService extends BaseService
{

    /**
     * randomize or set population and side effects
     *
     * @param City $city
     * @param array $cityPost
     */
    public function determinePopulation(City $city, array $cityPost) {
        $populationType = $cityPost['population_type'];

        if ($this->randomService->isRandom($populationType)) {
            $this->randomPopulationType($city);
        } else {
            $this->useEnteredPopulationType($city, $populationType);
        }

        // population size
        $this->randomPopulationSize($city);
    }

    private function randomPopulationType($city) {
        $city->population_type = $this->tableService->getTableResultRandom(Table::POPULATION_TYPE);
    }

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
                $city->population_type = $populationType;
                break;
            default:
                global $table_population_size;
                // they hand entered a value
                $entered_value = intval($populationType, 10);
                // check for bounds
                $city->population_type = false;
                if ($entered_value < $table_population_size[PopulationType::THORP][kMin]) {
                    $entered_value = $table_population_size[PopulationType::THORP][kMin];
                } else if ($entered_value > $table_population_size[PopulationType::METROPOLIS][kMax]) {
                    // hand entered a very large value, so make it a metropolis
                    $city->population_type = PopulationType::METROPOLIS;
                }
                // if population type not yet set, determine what it should be
                if (!$city->population_type) {
                    $city->population_type = $this->tableService->getTableKeyFromRangeValue(Table::POPULATION_SIZE, $entered_value);
                }
                $city->population_size = $entered_value;
                break;
        }
    }

    private function randomPopulationSize(City $city)
    {
        // check if it was hand entered so already set
        if ($city->population_size === false) {
            $value = $this->tableService->getTableResultIndex(Table::POPULATION_SIZE, $city->population_type);
            $city->population_size = $this->randRange($value[MinMax::MIN], $value[MinMax::MAX]);
        }
    }
}
