<?php

namespace App\Http\Controllers\CityGen\Util;

class TestRoll
{
    /** @var string  */
    public $name;
    /** @var int|string  */
    public $min;
    /** @var int|string  */
    public $max;
    /** @var int|string  */
    public $result;

    const ANY = 'any';
    const RANDOM = 'random';

    /**
     * TestRoll constructor.
     * @param string $name
     * @param int|string $min
     * @param int|string $max
     * @param int|string $result
     */
    public function __construct(string $name, $min, $max, $result)
    {
        $this->name = $name;
        $this->min = $min;
        $this->max = $max;
        $this->result = $result;
    }
}
