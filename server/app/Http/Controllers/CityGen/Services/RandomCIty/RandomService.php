<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

class RandomService
{
    const RANDOM = 'random';

    /**
     * @param string|int $value
     * @return bool
     */
    public function isRandom($value)
    {
        return $value === RandomService::RANDOM || !$value;
    }

    /**
     * do anything random through this method
     * this will allow a test random service class to hijack rolling to provide reproduceable results
     *
     * @param string $name
     * @return int
     */
    protected function mtRand($name)
    {
        return mt_rand();
    }

    /**
     * @param string $name
     * @param string|int $min
     * @param string|int $max
     * @return int
     */
    protected function mtRandRange($name, $min, $max)
    {
        return mt_rand($min, $max);
    }

    /**
     * @param string $name
     * @param string|int $min
     * @param string|int $max
     * @return int
     */
    public function randRange($name, $min, $max)
    {
        return $this->mtRandRange($name, $min, $max);
    }

    /**
     * @param string $name
     * @return float|int
     */
    public function randRatio($name)
    {
        return (float)$this->mtRand($name) / (float)getrandmax();
    }

    /**
     * @param $min
     * @param $max
     * @return float|int
     */
    public function randRatioRange($min, $max)
    {
        return rand_ratio() * ($max - $min) + $min;
    }
}
