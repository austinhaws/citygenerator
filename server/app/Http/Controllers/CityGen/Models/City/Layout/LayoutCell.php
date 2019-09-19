<?php

namespace App\Http\Controllers\CityGen\Models\City\Layout;

class LayoutCell
{
    /** @var int|null id of the ward that is claiming this space or null for an unclaimed cell */
    public $wardId = null;
    /** @var string[] which sides of the cell have walls */
    public $walls = array('left' => false, 'right' => false, 'top' => false, 'bottom' => false,);
    /** @var bool tells if this cell is inside walls (wards know this already, unclaimeds don't) true, false, null means don't know yet */
    public $insideWalls = null;

    /**
     * LayoutCell constructor.
     * @param int|null $wardId
     * @param bool|null $insideWalls
     */
    public function __construct($wardId, $insideWalls)
    {
        $this->wardId = $wardId;
        $this->insideWalls = $insideWalls;
    }

}
