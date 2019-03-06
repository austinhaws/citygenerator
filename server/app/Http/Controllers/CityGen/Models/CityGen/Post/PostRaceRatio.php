<?php

namespace App\Http\Controllers\CityGen\Models\CityGen\Post;

class PostRaceRatio
{
    /** @var string */
    public $race;
    /** @var float From UI value*/
    public $ratio;

    public function __construct(string $race, $ratio)
    {
        $this->race = $race;
        $this->ratio = $ratio;
    }
}
