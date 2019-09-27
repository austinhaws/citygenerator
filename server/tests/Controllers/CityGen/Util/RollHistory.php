<?php

namespace App\Http\Controllers\CityGen\Util;

class RollHistory
{
    /** @var string */
    public $name;
    /** @var int|string */
    public $min;
    /** @var int|string */
    public $max;
    /** @var int|string */
    public $result;
    /** @var TestRoll */
    public $roll;

    /**
     * TestRoll constructor.
     * @param string $name
     * @param int|string|callable $result
     * @param int|string $min
     * @param int|string $max
     * @param TestRoll $roll
     */
    public function __construct(string $name, $result, $min, $max, $roll)
    {
        $this->name = $name;
        $this->result = $result;
        $this->min = $min;
        $this->max = $max;
        $this->roll = $roll;
    }

    private function blankToNull($var)
    {
        $str = "{$var}";
        return ($str || $str === '0') ? $str : 'null';
    }

    public function recreate()
    {
        return "new TestRoll('{$this->name}', {$this->blankToNull($this->result)}, {$this->blankToNull($this->min)}, {$this->blankToNull($this->max)}),";
    }
}
