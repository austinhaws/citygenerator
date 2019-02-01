<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Services\BaseService;

class RandomCommoditiesService extends BaseService
{

    /**
     *
     * @param City $city
     * @param PostData $postData
     */
    public function determineCommodities(City $city, PostData $postData)
    {
        // how many commodities to generate
        $commodityMinMax = $this->services->table->getTableResultIndex(Table::COMMODITY_COUNT, $city->populationType);
        $this->fillCommodities($city->commoditiesExport, $this->services->random->randMinMax('Number Exports', $commodityMinMax));
        $this->fillCommodities($city->commoditiesImport, $this->services->random->randMinMax('Number Imports', $commodityMinMax));
    }

    /**
     * @param string[] &$commodities commodities array to load
     * @param int $total
     */
    private function fillCommodities(&$commodities, $total)
    {
        while (count($commodities) !== $total) {
            $commodity = $this->services->table->getTableResultRange(Table::COMMODITIES, $this->services->random->randRangeInt('Commodity', 1, 3700));
            if (array_search($commodity, $commodities) === false) {
                $commodities[] = $commodity;
            }
        }
        sort($commodities);
    }
}
