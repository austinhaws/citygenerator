<?php

namespace App\Http\Controllers\CityGen\Models\City\Layout;

class LayoutMeta
{
    /** @var int height of layout map */
    public $height;
    /** @var int width of layout map */
    public $width;
    /** @var int total number of cells in board (for quick reference) */
    public $numCells;
    /** @var int[] squares available for consumption  */
    public $unusedSquares = [];
    /** @var int[][] starting locations of city */
    public $startingLocations = [];
    /** @var int[] the four corners fo the board */
    public $startLocationsCorners = [];
    /** @var array int id => CityWard  */
    public $wardsById = [];

    /**
     * find neighbor cells to the given point
     *
     * @param int $point int number index in to city layout
     * @return int[] integer indexes in to city layout that are adjacent to this point
     */
    public function neighborSquares(int $point)
    {
        // check adjacent squares to point to see if they should be added to possible positions
        $possible_points = array();
        // up = $point - width; ok to be negative, it will be disallowed later
        $temp = $point - $this->width;
        if ($temp >= 0) {
            $possible_points['top'] = $temp;
        }
        // down = $point + width; ok to be off edge of map, it will be disallowed later
        $temp = $point + $this->width;
        if ($temp < $this->numCells) {
            $possible_points['bottom'] = $temp;
        }
        // left = $point - 1; watch for edges
        if ($point % $this->width != 0) {
            $possible_points['left'] = $point - 1;
        }
        // right = $point +1; watch for edges
        if (($point + 1) % $this->width != 0) {
            $possible_points['right'] = $point + 1;
        }
        return $possible_points;
    }

}
