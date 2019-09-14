<?php

namespace App\Http\Controllers\CityGen\Util;

use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;

include __DIR__ . '/../../../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

class TestRandomService extends RandomService
{

    /** @var TestRoll[]|TestRollGroup[] */
    private $rolls = null;
    private $rollIndex = 0;

    /**
     * @param null $name
     * @return int
     */
    protected function mtRand($name)
    {
        return $this->nextRoll($name);
    }

    /**
     * @param string $name
     * @param int $min
     * @param int $max
     * @return int
     */
    private function nextRoll($name, $min = null, $max = null)
    {
        if (!$this->rolls || count($this->rolls) === 0) {
//var_dump(debug_backtrace());
            throw new \RuntimeException("\nError: There are no more rolls for '$name' : $min -> $max; Roll Index: {$this->rollIndex}\n");
        }

        $roll = array_shift($this->rolls);

        if ($roll instanceof TestRollGroup) {
            $result = $this->doRoll($roll->nextRoll(), $name, $min, $max);

            if ($roll->isComplete()) {
                $this->rollIndex++;
            } else {
                array_unshift($this->rolls, $roll);
            }
        } else {
            $result = $this->doRoll($roll, $name, $min, $max);
            $roll->recordUse();
            if ($roll->isComplete()) {
                $this->rollIndex++;
            } else {
                array_unshift($this->rolls, $roll);
            }
        }
        return $result;
    }

    /**
     * show index information in case this is a roll group at this position
     *
     * @return string
     */
    private function rollIndexToString() {
        return "{$this->rollIndex}";
    }

    /**
     * @param TestRoll $roll
     * @param string $name
     * @param int $min
     * @param int $max
     * @return int
     */
    private function doRoll($roll, $name, $min, $max)
    {
        if ($roll->name !== TestRoll::ANY) {
            assertSame($roll->name, $name, "$name ($min->$max); Roll Index: {$this->rollIndexToString()} $min->$max");
        }
        if ($roll->min !== TestRoll::ANY) {
            assertSame($roll->min, $min, "MIN: $name; Roll Index: {$this->rollIndexToString()} $min->$max");
        }
        if ($roll->max !== TestRoll::ANY) {
            assertSame($roll->max, $max, "MAX: $name; Roll Index: {$this->rollIndexToString()} $min->$max");
        }

        // allow random results
        if (is_callable($roll->result)) {
            $result = call_user_func_array($roll->result, [$roll, $name, $min, $max]);
        } else if ($roll->result === TestRoll::RANDOM) {
            if ($min === null) {
                $result = parent::mtRand($name);
            } else {
                $result = parent::mtRandRange($name, $min, $max);
            }
        } else {
            $result = $roll->result;
        }

        return $result;
    }

    /**
     * do anything random through this method
     * this will allow a test random service class to hijack rolling to provide reproduceable results
     *
     * @param null $name
     * @param null $min
     * @param null $max
     * @return int
     */
    protected function mtRandRange($name, $min, $max)
    {
        return $this->nextRoll($name, $min, $max);
    }

    /**
     * @param TestRoll[] $rolls
     */
    public function setRolls($rolls)
    {
        $this->rolls && assertSame(0, count($this->rolls), 'Previous existing rolls');
        $this->rolls = $rolls;
        $this->rollIndex = 0;
    }

    public function verifyRolls()
    {
        if (count($this->rolls) === 1 && $this->rolls[0]->repeatTimes === TestRoll::INFINITE) {
            array_shift($this->rolls);
        }
        if (count($this->rolls) && $this->rolls[0] instanceof TestRollGroup) {
            $shouldBe = $this->rolls[0]->initialRepeatTimes - $this->rolls[0]->repeatTimes;
            var_dump("\n\n!!! not enough repeats in roll group (set repeats to {$shouldBe}): {$this->rolls[0]->repeatTimes} of {$this->rolls[0]->initialRepeatTimes} !!!\n\n");
            var_dump($this->rolls[0]);
        }
        $deadCount = count($this->rolls);
        assertSame(0, count($this->rolls), "all rolls accounted for (remove {$deadCount} rolls)");
    }
}
