<?php

namespace App\Http\Controllers\CityGen\Util;

class TestRoll extends TestRollBase
{
    /** @var string  */
    public $name;
    /** @var int|string  */
    public $min;
    /** @var int|string  */
    public $max;
    /** @var int|string  */
    public $result;

    /**
     * TestRoll constructor.
     * @param string $name
     * @param int|string $result
     * @param int|string $min
     * @param int|string $max
     * @param int|string $repeatTimes
     */
    public function __construct(string $name, $result, $min = null, $max = null, $repeatTimes = 1)
    {
        parent::__construct($repeatTimes);
        $this->name = $name;
        $this->result = $result;
        $this->min = $min;
        $this->max = $max;
    }
}
