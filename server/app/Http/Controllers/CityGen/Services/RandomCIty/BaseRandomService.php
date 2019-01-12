<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Controllers\CityGen\Services\TableService;

class BaseRandomService
{
    protected $tableService;

    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    protected function isRandom($value)
    {
        return $value === 'random' || !$value;
    }

    protected function randRange($min, $max)
    {
        return mt_rand($min, $max);
    }

    protected function randRatio()
    {
        return (float)mt_rand() / (float)getrandmax();
    }

    protected function randRatioRange($min, $max)
    {
        return rand_ratio() * ($max - $min) + $min;
    }
}
