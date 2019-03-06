<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\Post\PostData;

class RandomCityService extends BaseService
{
    /**
     * @param PostData $postData
     */
    public function randomizeCity(PostData $postData)
    {
        $city = new City();

        $this->services->randomCityPopulation->determinePopulation($city, $postData);
        $this->services->randomAcresStructures->randomAcres($city);
        $this->services->randomAcresStructures->randomNumStructures($city);
        $this->services->randomSeaRiverMilitaryGates->determineZones($city, $postData);
        $this->services->randomWards->determineWards($city, $postData);
        $this->services->randomProfessions->determineProfessions($city, $postData);
        $this->services->randomPowerCenters->determinePowerCenters($city);
        $this->services->randomRacesService->determineRaces($city, $postData);
        $this->services->randomGuild->determineGuilds($city);
        $this->services->randomCommodities->determineCommodities($city);
        $this->services->randomFamous->determineFamous($city);
        $this->services->randomName->generateName($city);
    }
}
