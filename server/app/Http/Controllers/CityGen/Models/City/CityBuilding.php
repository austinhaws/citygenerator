<?php

namespace App\Http\Controllers\CityGen\Models\City;

class CityBuilding
{
    /** @var string Building:: */
    public $building;
    /** @var string */
    public $subType;
    /** @var string */
    public $quality;

    public function __construct(string $building, ?string $subType, string $quality)
    {
        $this->building = $building;
        $this->subType = $subType;
        $this->quality = $quality;
    }
}
