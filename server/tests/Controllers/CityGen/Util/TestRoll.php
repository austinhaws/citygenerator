<?php

namespace App\Http\Controllers\CityGen\Util;

class TestRoll
{
    /** @var int  */
    public $rollMin;
    /** @var int  */
    public $rollMax;
    /** @var int  */
    public $rollResult;

    public function __construct(int $rollMin, int $rollMax, int $rollResult)
    {
        $this->rollMax = $rollMax;
        $this->rollMin = $rollMin;
        $this->rollResult = $rollResult;
    }
}
