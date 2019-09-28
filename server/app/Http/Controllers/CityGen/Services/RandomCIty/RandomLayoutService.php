<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity\Layout;

use App\Http\Common\Models\MinMax;
use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Constants\Ward;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\City\CityLayout;
use App\Http\Controllers\CityGen\Models\City\CityWard;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutCell;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutMap;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutPosition;
use App\Http\Controllers\CityGen\Models\Post\PostData;
use App\Http\Controllers\CityGen\Util\ArrayUtil;

class RandomLayoutService extends BaseService
{
    // this determines how much larger wards are than just 1:1; don't ever have this less than 1
    private const WARD_BLOAT_FACTOR = 8.0;
    const FILTER = 'filter';
    const PARAMS = 'params';

    /**
     * @param City $city
     * @param PostData $postData
     */
    public function generateLayout(City $city, PostData $postData)
    {
        if ($postData->generateLayout === BooleanRandom::TRUE) {
            // create the cells array of the right size and determine height/width of layout
            $layoutMap = $this->createCellLayout($city);

            // setup starting locations in rings
            $this->setupRings($layoutMap);

            // pick a starting position for each ward
            $this->setStartingPositions($city, $layoutMap);

            // once all wards have a start position, loop through them all and place a square
            $this->allocateWards($city, $layoutMap);

            // set up cells array with wards and empty spaces information in preparation for walls
            $this->loadMapCells($city, $layoutMap);

            // determine which cells have walls on which sides
            $this->addWalls($layoutMap);

            // load up city with relevant information (just what city needs to know to render)
            $city->layout = new CityLayout($layoutMap);
        }
    }

    /**
     * determine height/width of the city and create unused_squares array of point indexes
     * @param City $city
     * @return LayoutMap
     */
	private function createCellLayout(City $city)
	{
        $layoutMap = new LayoutMap();

        // get the average density of building types for the city's population type
		$densities = $this->services->table->getTableResultIndex(Table::POPULATION_WARD_DENSITY, $city->populationType);
		$averageWardDensity = array_sum(array_values($densities)) / count($densities);

		// get the total cells for all the wards
        $buildingCounts = array_map(function ($ward) use ($averageWardDensity, $layoutMap) {
            return $layoutMap->getLayoutWard($ward)->numberCells = intval(max(1, intval(count($ward->buildings) / $averageWardDensity)) * RandomLayoutService::WARD_BLOAT_FACTOR);
        }, $city->wards);

        // add some bloat to number of cells (ie "* 1.05") for the edges and inconsistencies and ward holes
        $numCells = intval(array_reduce($buildingCounts, function ($total, $count) { return $total + $count; }, 0) * 1.05);

		// get random ratio (weighted towards .5) for determining height vs width
		// this determines the root to use when dividing cells
		// for a square city, # of cells in height or width = sqroot of total cells, doing different roots gives different shapes
        // if min/max ratios change, make sure to test against Layout_CityMapClass::WARD_BLOAT_FACTOR
		$ratio = $this->services->random->randMinMaxFloat('Layout: Height/Width ratio', new MinMax(.45, .55));

		// get height/width to be a rectangle
        $height = max(1, intval(pow($numCells, $ratio)));
        $width = max(1, intval($numCells / $height));
        while ($width * $height < $numCells) {
			// alternate
			if (($width + $height) % 2) {
                $width++;
			} else {
                $height++;
			}
		}
        $layoutMap->setWidthHeight($width, $height);

        return $layoutMap;
    }

    /**
     * rings are like an onion of rings of a city.
     * each ring is a rectangle of the city one size smaller than the rectangle surrounding it
     * starting locations can then be taken from any ring
     * things that are on the outside of the city can then start on the outside ring
     * each ring then is possible starting points; rings are also available points
     * @param LayoutMap $layoutMap
     */
	private function setupRings(LayoutMap $layoutMap)
	{
	    // example rings: +, A, B, and C are rings of the city
	    // ++++++++
        // +AAAAAA+
        // +ABBBBA+
        // +ABCCBA+
        // +ABCCBA+ <--- this row may or may not exist based on the rectangle
        // +ABBBBA+
        // +AAAAAA+
        // ++++++++

        $ringCount = intval(ceil(min($layoutMap->height, $layoutMap->width) / 2));
	    for ($ringLoop = 0; $ringLoop < $ringCount; $ringLoop++) {
            $endY = $layoutMap->height - $ringLoop - 1;
            $endX = $layoutMap->width - $ringLoop - 1;
            $ring = [];
            for ($y = $ringLoop; $y <= $endY; $y++) {
                for ($x = $ringLoop; $x <= $endX; $x++) {
                    // only put rectangle outside positions in ring
                    if ($y === $ringLoop || $y === $endY ||
                        $x === $ringLoop || $x === $endX) {
                        $ring[] = new LayoutPosition($x, $y);
                    }
                }
            }
            $layoutMap->rings[] = $ring;
		}
	}

    /**
     * set starting positions for every ward
     * @param City $city
     * @param LayoutMap $layoutMap
     */
    private function setStartingPositions(City $city, LayoutMap $layoutMap)
    {
        $filters = [
            // Sea
            [
                self::FILTER => function ($ward) { return $ward->type === Ward::SEA; },
                self::PARAMS => function () { return [false, true]; },
            ],
            // River
            [
                self::FILTER => function ($ward) { return $ward->type === Ward::RIVER; },
                self::PARAMS => function () { return [false, true]; },
            ],
            // non-Sea non-Gate
            [
                self::FILTER => function ($ward) {
                    return $ward->type !== Ward::RIVER &&
                        $ward->type !== Ward::SEA &&
                        $ward->type !== Ward::GATE;
                },
                self::PARAMS => function ($ward) { return [$ward->insideWalls, false]; },
            ],
            // Gate
            [
                self::FILTER => function ($ward) { return $ward->type === Ward::GATE; },
                self::PARAMS => function () { return [false, false]; },
            ],
        ];

        foreach ($filters as $wardFilter) {
            foreach ($city->wards as $ward) {
                if ($wardFilter[self::FILTER]($ward)) {
                    $params = $wardFilter[self::PARAMS]($ward);
                    $point = $this->getStartingPoint($layoutMap, $params[0], $params[1]);
                    $this->addWardMapPosition($ward, $layoutMap, $point);
                }
            }
        }
    }

    /**
     * once all wards have a start position, loop through them all and place a square
     * @param City $city
     * @param LayoutMap $layoutMap
     */
	private function allocateWards(City $city, LayoutMap $layoutMap)
	{
        $useWards = $city->wards;
        while (count($useWards)) {
            $useWards = array_filter($useWards, function ($ward) use ($layoutMap) {
                return $this->addLayoutSquare($layoutMap, $ward);
            });
        }
	}

    /**
     * get a point from ringed started points
     *
     * @param LayoutMap $layoutMap
     * @param $insideWalls true if the ward should be inside walls (placed in inner rings)
     * @param $outsideRing true if the ward should be in a corner (outter ring corner); this trumps inside_walls
     * @return LayoutPosition point of the starting position
     */
    public function getStartingPoint(LayoutMap $layoutMap, $insideWalls, $outsideRing)
    {
        do {
            if ($insideWalls) {
                $ringIdx = count($layoutMap->rings) - 1;
            } else if ($outsideRing) {
                $ringIdx = 0;
            } else {
                $ringIdx = $this->services->random->randMinMaxInt('Layout: Starting Ring', new MinMax(0, count($layoutMap->rings) - 1));
            }

            $idx = $this->services->random->randMinMaxInt('Layout: Pick Starting Point', new MinMax(0, count($layoutMap->rings[$ringIdx]) - 1));
            $point = array_splice($layoutMap->rings[$ringIdx], $idx,1)[0];

            // check if point is unused
            $pointIdx = ArrayUtil::array_find_idx(
                $layoutMap->unusedPositions,
                function (LayoutPosition $testPoint) use ($point) { return $point->equals($testPoint); }
            );
            if ($pointIdx === null) {
                // point has already been used, try again...
                $point = null;
            } else {
                array_splice($layoutMap->unusedPositions, $pointIdx, 1);
            }

            // check if ring is empty
            if (0 === count($layoutMap->rings[$ringIdx])) {
                array_splice($layoutMap->rings, $ringIdx, 1);
            }

        } while ($point === null);

        return $point;
    }

    /**
     * randomly add a map square to the ward from the list of possible locations adjacent to the ward
     *
     * @param LayoutMap $layoutMap
     * @param CityWard $ward
     * @return bool true if a point was added, false if there is no more room to grow or has reached max size
     */
    public function addLayoutSquare(LayoutMap $layoutMap, CityWard $ward) {
        $point = false;

        $layoutWard = $layoutMap->getLayoutWard($ward);

        // don't add more points if already reached limit
        if (count($layoutWard->mapPositions) < $layoutWard->numberCells && count($layoutWard->mapPositionsPossible)) {
            do {
                // get random position from possible positions
                $idx = $this->services->random->randMinMaxInt('Layout: Pick Point', new MinMax(0, count($layoutWard->mapPositionsPossible) - 1));
                $point = array_splice($layoutWard->mapPositionsPossible, $idx,1)[0];

                // make sure position is in unused positions
                $idx = array_search($point, $layoutMap->unusedPositions);
                if ($idx === false) {
                    // point must have been grabbed by another ward, go find another one
                    $point = false;
                } else {
                    // good to go! remove from unused_squares
                    array_splice($layoutMap->unusedPositions, $idx, 1);
                    // add to ward, including finding possible neighbor squares in which to spread
                    $this->addWardMapPosition($ward, $layoutMap, $point);
                }
            } while ($point === false && count($layoutWard->mapPositionsPossible));
        }

        return $point !== false;
    }


    /**
     * add a map cell to the ward
     * @param CityWard $ward
     * @param LayoutMap $layoutMap
     * @param LayoutPosition $position
     */
    public function addWardMapPosition(CityWard $ward, LayoutMap $layoutMap, LayoutPosition $position)
    {
        $layoutWard = $layoutMap->getLayoutWard($ward);
        $layoutWard->mapPositions[] = $position;
        $this->addWardPossiblePositions($ward, $layoutMap, $position);
    }

    /**
     * find available cells around the added point (these may not be available when it comes time to add a new cell,
     * but adding them now instead of every time through point finding seems more efficient
     * @param CityWard $ward
     * @param LayoutMap $layoutMap
     * @param LayoutPosition $position
     */
    private function addWardPossiblePositions(CityWard $ward, LayoutMap $layoutMap, LayoutPosition $position)
    {
        $layoutWard = $layoutMap->getLayoutWard($ward);
        $deltas = $layoutMap->neighborSquares($position);

        $keepers = array_filter($deltas, function ($delta) use ($layoutWard, $layoutMap) {
            return array_search($delta, $layoutMap->unusedPositions) !== false &&
                // don't put duplicates in $this->map_positions_possible
                array_search($delta, $layoutWard->mapPositionsPossible) === false;
        });

        array_walk($keepers, function ($possible_point) use ($layoutWard) {
            $layoutWard->mapPositionsPossible[] = $possible_point;
        });
    }

    private function addUnclaimedNeighborsToEmptyWard(LayoutMap $layoutMap, LayoutPosition $layoutPosition, CityWard $cityWard)
    {
        // update map cell with empty ward
        if ($layoutMap->getCell($layoutPosition) === null) {
            $layoutMap->setCell($layoutPosition, new LayoutCell($cityWard->id, $cityWard->insideWalls));

            // find empty neighbors
            $neighbors = $layoutMap->neighborSquares($layoutPosition);
            $unclaimedNeighbors = array_filter($neighbors, function (LayoutPosition $neighbor) use ($layoutMap) {
                return $layoutMap->getCell($neighbor) === null;
            });

            // add empty neighbors to the ward
            array_walk($unclaimedNeighbors, function ($unclaimedNeighbor) use ($layoutMap, $cityWard) {
                $this->addUnclaimedNeighborsToEmptyWard($layoutMap, $unclaimedNeighbor, $cityWard);
            });
        }
    }

    /**
     * load cells array with all the wards positions and empty positions as Layout_CellClass
     * @param City $city
     * @param LayoutMap $layoutMap
     */
    public function loadMapCells(City $city, LayoutMap $layoutMap)
    {
        array_walk($city->wards, function ($ward) use ($layoutMap) {
            $layoutWard = $layoutMap->getLayoutWard($ward);
            array_walk($layoutWard->mapPositions, function ($position) use ($ward, $layoutMap) {
                $layoutMap->setCell($position, new LayoutCell($ward->id, $ward->insideWalls));
            });
        });

        for ($y = 0; $y < $layoutMap->height; $y++) {
            for ($x = 0; $x < $layoutMap->width; $x++) {
                $cell = $layoutMap->cells[$y][$x];
                if ($cell === null) {
                    $emptyCityWard = new CityWard();
                    $emptyCityWard->insideWalls = $this->services->random->percentile('Empty cell inside walls') > 50;
                    $emptyCityWard->type = Ward::LAYOUT_EMPTY;
                    $city->wards[] = $emptyCityWard;
                    $layoutMap->addLayoutWard($emptyCityWard);
                    $this->addUnclaimedNeighborsToEmptyWard($layoutMap, new LayoutPosition($x, $y), $emptyCityWard);
                }
            }
        }
    }


    /**
     * set walled status on all unclaimed cells and set wall sides on all walled cells bordering unwalled
     * @param LayoutMap $layoutMap
     */
    public function addWalls(LayoutMap $layoutMap)
    {
        // for each cell, if a side's neighbor's wall status is not the same then put a wall on that side
        // if neighbor is a border, then if this ward has walls, then put a wall on that side
        array_walk($layoutMap->cells, function ($rowCells, $y) use ($layoutMap) {
            array_walk($rowCells, function (LayoutCell $cell, $x) use ($layoutMap, $y) {
                // get neighbor positions that are on the map
                $neighbors = $layoutMap->neighborSquares(new LayoutPosition($x, $y));
                $neighborCells = array_map(function ($layoutPosition) use ($layoutMap) {
                    return $layoutMap->getCell($layoutPosition);
                }, $neighbors);
                $layoutMapWard = $layoutMap->getLayoutWardById($cell->wardId);

                // top
                if (isset($neighborCells[LayoutMap::DIRECTION_UP])) {
                    $cell->walls[LayoutMap::DIRECTION_UP] = $neighborCells[LayoutMap::DIRECTION_UP]->insideWalls !== $cell->insideWalls;
                } else {
                    $cell->walls[LayoutMap::DIRECTION_UP] = $layoutMapWard->ward->insideWalls;
                }

                // down
                if (isset($neighborCells[LayoutMap::DIRECTION_DOWN])) {
                    $cell->walls[LayoutMap::DIRECTION_DOWN] = $neighborCells[LayoutMap::DIRECTION_DOWN]->insideWalls !== $cell->insideWalls;
                } else {
                    $cell->walls[LayoutMap::DIRECTION_DOWN] = $layoutMapWard->ward->insideWalls;
                }

                // left
                if (isset($neighborCells[LayoutMap::DIRECTION_LEFT])) {
                    $cell->walls[LayoutMap::DIRECTION_LEFT] = $neighborCells[LayoutMap::DIRECTION_LEFT]->insideWalls !== $cell->insideWalls;
                } else {
                    $cell->walls[LayoutMap::DIRECTION_LEFT] = $layoutMapWard->ward->insideWalls;
                }

                // right
                if (isset($neighborCells[LayoutMap::DIRECTION_RIGHT])) {
                    $cell->walls[LayoutMap::DIRECTION_RIGHT] = $neighborCells[LayoutMap::DIRECTION_RIGHT]->insideWalls !== $cell->insideWalls;
                } else {
                    $cell->walls[LayoutMap::DIRECTION_RIGHT] = $layoutMapWard->ward->insideWalls;
                }
            });

        });
    }
}