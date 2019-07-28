<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Models\City\City;

class RandomFamousService extends BaseService
{

    /**
     * @param City $city
     */
    public function determineFamous(City $city)
    {
        $famousMinMax = $this->services->table->getTableResultIndex(Table::FAMOUS_OCCURRENCE, $city->populationType);
        $this->services->table->fillRandomStrings($city->famous, Table::FAMOUS, $this->services->random->randMinMaxInt('Number Famous', $famousMinMax));
        $this->services->table->fillRandomStrings($city->infamous, Table::FAMOUS, $this->services->random->randMinMaxInt('Number Infamous', $famousMinMax));
    }
}
