<?php

namespace App\Http\Controllers\CityGen\Util;

use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;

include __DIR__ . '/../../../../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

class TestRandomService extends RandomService
{

    /** @var TestRoll[]  */
    private $rolls = null;

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
        if (count($this->rolls) === 0) {
            var_dump(debug_backtrace());
            exit("There are no more rolls for $name : $min -> $max");
        }

        $roll = array_shift($this->rolls);
        assertSame($name, $roll->name, "$name ($min->$max)");
        if ($roll->min !== TestRoll::ANY) {
            assertSame($min, $roll->min, $name);
        }
        if ($roll->max !== TestRoll::ANY) {
            assertSame($max, $roll->max, $name);
        }

        // allow random results
        if ($roll->result === TestRoll::RANDOM) {
            if ($roll->min === null || $roll->min === TestRoll::ANY) {
                $result = parent::mtRandRange($name, $min, $max);
            } else {
                $result = parent::mtRand($name);
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
        assertSame(0, count($this->rolls), 'Previous≠ existing rolls');
        $this->rolls = $rolls;
    }

    public function verifyRolls()
    {
        assertSame(0, count($this->rolls), 'all rolls accounted for');
    }
}
