<?php

namespace App\Http\Controllers\CityGen\Util;

abstract class TestRollBase
{
    /** @var int|string how many times to run until going to next roll */
    public $repeatTimes;
    /** @var int|string initial value for repeat times (roll groups reset to this) */
    public $initialRepeatTimes;

    const ANY = 'any';
    const RANDOM = 'random';
    const INFINITE = 'infinite';


    /**
     * TestRoll constructor.
     * @param int|string $repeatTimes
     */
    public function __construct($repeatTimes)
    {
        $this->repeatTimes = $repeatTimes;
        $this->initialRepeatTimes = $repeatTimes;
    }

    /**
     * @return bool has this Roll repeated the expected number of times
     */
    public function isComplete() {
        return $this->repeatTimes !== TestRollBase::INFINITE && $this->repeatTimes === 0;
    }

    /**
     * reset back to initial repeat times
     */
    public function resetRepeatTimes() {
        $this->repeatTimes = $this->initialRepeatTimes;
    }

    public function recordUse() {
        if ($this->repeatTimes !== TestRoll::INFINITE) {
            $this->repeatTimes--;
        }
    }
}
