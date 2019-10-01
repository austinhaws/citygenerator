<?php

namespace App\Http\Controllers\CityGen\Models\City\Layout;

use App\Http\Controllers\CityGen\Models\City\CityWard;

class LayoutMap
{
    /** @var LayoutCell[][] */
    public $cells;
    /** @var int height of layout map */
    public $height;
    /** @var int width of layout map */
    public $width;
    /** @var int total number of cells in board (for quick reference) */
    public $numCells;
    /** @var LayoutPosition[] squares available for consumption  */
    public $unusedPositions = [];
    /** @var LayoutPosition[][] starting locations of city broken in to rings */
    public $rings = [];
    /** @var array int id => LayoutMapWard  */
    public $wardsById = [];

    /** @var LayoutPosition[] changes to get possible neighbors  */
    private $neighborDeltas;

    public const DIRECTION_LEFT = 'left';
    public const DIRECTION_RIGHT = 'right';
    public const DIRECTION_UP = 'up';
    public const DIRECTION_DOWN = 'down';

    public function __construct()
    {
        $this->neighborDeltas = [
            self::DIRECTION_LEFT => new LayoutPosition(-1, 0),
            self::DIRECTION_RIGHT => new LayoutPosition(1, 0),
            self::DIRECTION_UP => new LayoutPosition(0, -1),
            self::DIRECTION_DOWN => new LayoutPosition(0, 1),
        ];
    }

    /**
     * @param int $width
     * @param int $height
     */
    public function setWidthHeight($width, $height) {
        $this->height = $height;
        $this->width = $width;
        $this->numCells = $height * $width;

        $this->cells = array_fill(0, $height, array_fill(0, $width, null));

        // setup unused squares array
        $this->unusedPositions = [];
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $this->unusedPositions[] = new LayoutPosition($x, $y);
            }
        }
    }

    /**
     * find neighbor cells to the given point
     *
     * @param LayoutPosition $point
     * @return LayoutPosition[] points in city layout that are adjacent to this point
     */
    public function neighborSquares(LayoutPosition $point)
    {
        $neighbors = array_map(function ($delta) use ($point) {
            return $point->delta($delta);
        }, $this->neighborDeltas);

        return array_filter($neighbors, function ($point) {
            return $point->x >= 0 && $point->x < $this->width &&
                $point->y >= 0 && $point->y < $this->height;
        });
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
     * @return LayoutCell | null
     */
    public function getCell(LayoutPosition $position)
    {
        return isset($this->cells[$position->y][$position->x]) ? $this->cells[$position->y][$position->x] : null;
    }

    /**
     * @param CityWard $ward
     * @return LayoutMapWard
     */
    public function getLayoutWard(CityWard $ward)
    {
        if (!isset($this->wardsById[$ward->id])) {
            $this->wardsById[$ward->id] = new LayoutMapWard($ward);
        }
        return $this->wardsById[$ward->id];
    }

    public function addLayoutWard(CityWard $ward)
    {
        $this->wardsById[$ward->id] = new LayoutMapWard($ward);
    }

    /**
     * @param int $wardId
     * @return LayoutMapWard
     */
    public function getLayoutWardById(int $wardId)
    {
        if (!isset($this->wardsById[$wardId])) {
            throw new \Exception('Missing ward for id: ' . $wardId);
        }
        return $this->wardsById[$wardId];
    }

}
