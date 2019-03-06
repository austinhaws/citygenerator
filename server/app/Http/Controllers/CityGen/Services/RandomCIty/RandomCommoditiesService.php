<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Models\CityGen\City\City;

class RandomCommoditiesService extends BaseService
{

    /**
     *
     * @param City $city
     */
    public function determineCommodities(City $city)
    {
        $minMax = $this->services->table->getTableResultIndex(Table::COMMODITY_COUNT, $city->populationType);
        $this->services->table->fillRandomStrings($city->commoditiesExport, Table::COMMODITIES, $this->services->random->randMinMax('Number Exports', $minMax));
        $this->services->table->fillRandomStrings($city->commoditiesImport, Table::COMMODITIES, $this->services->random->randMinMax('Number Imports', $minMax));
    }
}
