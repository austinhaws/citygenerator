<?php

namespace App\Http\Controllers\CityGen\Util;

use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;
use PHPUnit\Framework\TestCase;

include __DIR__ . '/../../../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

class TestRandomService extends RandomService
{

    /** @var TestRoll[]  */
    private $rolls = null;

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
        if ($this->rolls !== null) {
            $roll = array_shift($this->rolls);
            assertEquals($min, $roll->rollMin);
            assertEquals($max, $roll->rollMax);
            $result = $roll->rollResult;
        } else {
            $result = $min === null ? mt_rand() : mt_rand($min, $max);
        }
        return $result;
    }

    /**
     * @param TestRoll[] $rolls
     */
    public function setRolls($rolls)
    {
        $this->rolls = $rolls;
    }
}
