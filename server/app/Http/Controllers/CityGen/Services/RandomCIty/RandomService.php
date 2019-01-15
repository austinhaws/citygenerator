<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

class RandomService
{
    public function isRandom($value)
    {
        return $value === 'random' || !$value;
    }

    /**
     * do anything random through this method
     * this will allow a test random service class to hijack rolling to provide reproduceable results
     *
     * @param null $min
     * @param null $max
     * @return int
     */
    protected function mtRand($min = null, $max = null)
    {
        return $min === null ? mt_rand() : mt_rand($min, $max);
    }

    public function randRange($min, $max)
    {
        return $this->mtRand($min, $max);
    }

    public function randRatio()
    {
        return (float)$this->mtRand() / (float)getrandmax();
    }

    public function randRatioRange($min, $max)
    {
        return rand_ratio() * ($max - $min) + $min;
    }
}
