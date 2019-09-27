<?php

namespace App\Http\Controllers\CityGen\Models\City\Layout;

use App\Http\Controllers\CityGen\Models\City\CityWard;

class LayoutMapWard
{
    /** @var CityWard */
    public $ward;
    /** @var LayoutPosition[] a list of the taken cells on the map for this ward */
    public $mapPositions = [];
    /** @var LayoutPosition[] what positions are adjacent to already existing squares for this ward */
    public $mapPositionsPossible = [];
    /** @var int how many cells this ward will consume*/
    public $numberCells;

    public function __construct(CityWard $ward)
    {
        $this->ward = $ward;
    }

    /**
     * find neighbor cells to the given point
     *
     * @param LayoutPosition $point
     * @return LayoutPosition[] points in city layout that are adjacent to this point
     */
    public function neighborSquares(LayoutPosition $point)
    {
        return array_filter(
            array_map(function ($delta) use ($point) {
                return $point->delta($delta);
            }, $this->neighborDeltas),
            function ($point) {
                return $point->x >= 0 && $point->x <= $this->width &&
                    $point->y >= 0 && $point->y <= $this->height;
            }
        );
    }

    /**
     * @param LayoutPosition $position
     * @param LayoutCell $cell
     */
    public function setCell(LayoutPosition $position, LayoutCell $cell)
    {
        $this->cells[$position->y][$position->x] = $cell;
    }

    /**
     * @param LayoutPosition $position
     * @return LayoutCell
     */
    public function getCell(LayoutPosition $position)
    {
        return $this->cells[$position->y][$position->x];
    }

    public function addWardMapPosition(\App\Http\Controllers\CityGen\Models\City\CityWard $ward, int $point)
    {
    }
    /**
     * add a map square to the ward (called direclty only for starting position, everything else should use add_layout_square()
     * @param int $point
     * @param LayoutMeta $layoutMeta
     */
    public function addMapPosition(int $point, LayoutMeta $layoutMeta) {
        $this->mapPositions[] = $point;
        $this->addPossiblePositions($point, $layoutMeta);
    }

}
