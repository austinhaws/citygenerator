<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Controllers\CityGen\Services\BaseService;

class RandomBuildingsService extends BaseService
{
    public function generateBuildings($ward, $buildingWeights)
    {
        echo "TODO: implement RandBuildingsService::generateBuildings\n";


        usort($ward->buildings, function($a, $b) {
            return strcmp($a['key'], $b['key']);
        });
    }
}
