<?php

namespace App\Http\Controllers\CityGen\Models\City;

class CityNPCLevelCount
{
    /** @var int */
    public $level;
    /** @var int */
    public $count;

    public function __construct(int $level, int $count = 0)
    {
        $this->level = $level;
        $this->count = $count;
    }
}
