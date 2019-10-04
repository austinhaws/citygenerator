<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Common\Models\MinMax;
use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\BooleanRandom;

class RandomService extends BaseService
{
    const RANDOM = 'Random';
    const CUSTOM = 'Custom';

    public function isTrue(&$value) {
        if ($this->isRandom($value)) {
            $value = $this->percentile('Random True/False') > 50;
        }
        return $value === BooleanRandom::TRUE;
    }

    /**
     * @param string|int $value
     * @return bool
     */
    public function isRandom($value)
    {
        return $value === RandomService::RANDOM || !$value;
    }

    public function randomBoolean($post, $field)
    {
        $value = null;
        if (isset($post[$field])) {
            $value = $post[$field];
        }

        if ($value !== BooleanRandom::TRUE &&
            $value !== BooleanRandom::FALSE &&
            $value !== BooleanRandom::RANDOM
        ) {
            $value = BooleanRandom::RANDOM;
        }

        return $value;
    }

    /**
     * do anything random through this method
     * this will allow a test random service class to hijack rolling to provide reproducible results
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
     * @return float
     */
    public function randRangeFloat($name, $min, $max)
    {
        return $min === $max ? $min : $this->mtRandRange($name, $min, $max);
    }

    /**
     * @param $name
     * @param int $min
     * @param int $max
     * @return int
     */
    public function randRangeInt($name, int $min, int $max)
    {
        return intval($this->randRangeFloat($name, $min, $max));
    }

    /**
     * @param string $name
     * @return float
     */
    public function randRatio(string $name)
    {
        return (float)$this->mtRand($name) / (float)getrandmax();
    }

    /**
     * @param $name
     * @param $min
     * @param $max
     * @return float
     */
    public function randRatioRange(string $name, int $min, int $max)
    {
        $ratio = $this->randRatio($name);
        return $ratio * ($max - $min) + $min;
    }

    /**
     * @param string $name
     * @return int
     */
    public function percentile(string $name)
    {
        return $this->randRangeInt($name, 1, 100);
    }

    /**
     * @param string $name
     * @param MinMax $minMax [MinMax::MIN => #, MinMax::Max => #]
     * @return int
     */
    public function randMinMaxInt(string $name, MinMax $minMax)
    {
        return $this->randRangeInt($name, $minMax->min, $minMax->max);
    }
    /**
     * @param string $name
     * @param MinMax $minMax [MinMax::MIN => #, MinMax::Max => #]
     * @return int
     */
    public function randMinMaxFloat(string $name, MinMax $minMax)
    {
        return $this->randRangeInt($name, $minMax->min * 100 , $minMax->max * 100) / 100.0;
    }

    /**
     * @param string $name
     * @return string (BooleanRandom...)
     */
    public function boolean(string $name)
    {
        return $this->percentile($name) > 50 ? BooleanRandom::TRUE : BooleanRandom::FALSE;
    }
}
