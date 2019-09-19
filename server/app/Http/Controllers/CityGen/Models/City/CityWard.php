<?php

namespace App\Http\Controllers\CityGen\Models\City;

use App\Http\Controllers\CityGen\Models\City\Layout\LayoutMeta;

class CityWard
{
    private static $nextId = 1;

    /** @var int unique ID for the ward in the city */
    public $id;
    /** @var string Ward:: enum */
    public $type;
    /** @var int */
    public $acres;
    /** @var bool */
    public $insideWalls;
    /** @var CityBuilding[] */
    public $buildings = [];
    /** @var int[] a list of the integer position of taken cells on the map for this ward */
    private $mapPositions = [];
    /** @var int[] what positions are adjacent to already existing squares for this ward */
    private $mapPositionsPossible = [];
    /** @var int how many cells this ward will consume*/
    public $numberCells;

    public function __construct()
    {
        $this->id = $this::$nextId++;
    }

    /**
     * @return int[] map Positions
     */
    public function getMapPositions() {
        return $this->mapPositions;
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

    /**
     * find available cells around the added point (these may not be available when it comes time to add a new cell,
     * but adding them now instead of every time through point finding seems more efficient
     * @param int $point the point around which to find possibles
     * @param LayoutMeta $layoutMeta the layout containing height/width/unused cells information
     */
    private function addPossiblePositions(int $point, LayoutMeta $layoutMeta) {
        foreach ($layoutMeta->neighborSquares($point) as $possible_point) {
            // make sure the point is unclaimed
            if (array_search($possible_point, $layoutMeta->unusedSquares) !== false &&
                // don't put duplicates in $this->map_positions_possible
                array_search($possible_point, $this->mapPositionsPossible) === false) {
                    $this->mapPositionsPossible[] = $possible_point;
            }
        }
    }

    /**
     * randomly add a map square to the ward from the list of possible locations adjacent to the ward
     *
     * @param LayoutMeta $layoutMeta the layout object for information about height/width
     * @return bool true if a point was added, false if there is no more room to grow or has reached max size
     */
    public function addLayoutSquare(LayoutMeta $layoutMeta) {
        $point = false;

        // don't add more points if already reached limit
        if (count($this->mapPositions) < $this->numberCells && count($this->mapPositionsPossible)) {
            do {
                // get random position from possible positions
                shuffle($this->mapPositionsPossible);
                $point = array_shift($this->mapPositionsPossible);

                // make sure position is in unused positions
                $idx = array_search($point, $layoutMeta->unusedSquares);
                if ($idx === false) {
                    // point must have been grabbed by another ward, go find another one
                    $point = false;
                } else {
                    // good to go! remove from unused_squares
                    unset($layoutMeta->unusedSquares[$idx]);
                    // add to ward, including finding possible neighbor squares in which to spread
                    $this->addMapPosition($point, $layoutMeta);
                }
            } while ($point === false && count($this->mapPositionsPossible));
        }

        return $point;
    }

}
