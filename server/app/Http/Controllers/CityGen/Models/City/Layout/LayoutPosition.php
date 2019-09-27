<?php

namespace App\Http\Controllers\CityGen\Models\City\Layout;

class LayoutPosition
{
    /** @var int */
    public $x;
    /** @var int */
    public $y;

    /**
     * LayoutPosition constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function delta(LayoutPosition $delta)
    {
        return new LayoutPosition($this->x + $delta->x, $this->y + $delta->y);
    }

    public function equals(LayoutPosition $position)
    {
        return $this->x === $position->x && $this->y === $position->y;
    }
}
