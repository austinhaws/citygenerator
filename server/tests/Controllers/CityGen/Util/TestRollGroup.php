<?php

namespace App\Http\Controllers\CityGen\Util;

class TestRollGroup extends TestRollBase
{
    /** @var string */
    public $title;
    /** @var TestRollGroup[]|TestRoll[]  */
    public $rolls;
    /** @var int loop index in the group */
    private $loopIndex;

    /**
     * TestRoll constructor.
     * @param [string] $rolls
     * @param int|string $repeatTimes
     */
    public function __construct($title, $rolls, $repeatTimes)
    {
        parent::__construct($repeatTimes);
        if (!count($rolls)) {
            throw new Exception("$title - Must have rolls");
        }
        $this->title = $title;
        $this->rolls = $rolls;
        $this->loopIndex = 0;
    }

    /**
     * @return TestRoll give the next roll in the group (loops back to start of rolls in group)
     * @throws \Exception
     */
    public function nextRoll() {
        if ($this->isComplete()) {
            throw new \Exception("Roll Group '{$this->title}' is trying to repeat too many times ({$this->initialRepeatTimes})");
        }
        $roll = $this->rolls[$this->loopIndex];

        if ($roll instanceof TestRollGroup) {
            $rollResult = $roll->nextRoll();
        } else {
            $rollResult = $roll;
            $rollResult->recordUse();
        }

        // move to next roll if it's done repeating
        if ($roll->isComplete()) {
            $this->loopIndex++;
            if ($this->loopIndex >= count($this->rolls)) {
                $this->loopIndex = 0;
                $this->recordUse();

                foreach ($this->rolls as $roll) {
                    $roll->resetRepeatTimes();
                }
            }
        }

        return $rollResult;
    }
}
