<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Common\Models\MinMax;
use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Constants\Ward;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\City\CityWard;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutCell;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutMeta;
use App\Http\Controllers\CityGen\Models\Post\PostData;

class RandomLayoutService extends BaseService
{
    // this determines how much larger wards are than just 1:1; don't ever have this less than 1
    private const WARD_BLOAT_FACTOR = 8.0;
    /** @var LayoutMeta */
    private $layoutMeta;

    /**
     * @param City $city
     * @param PostData $postData
     */
    public function generateLayout(City $city, PostData $postData)
    {
        $this->layoutMeta = new LayoutMeta();

        // create the cells array of the right size and determine height/width of layout
        $this->createCellLayout($city);

        // setup starting locations in layers
        $this->setupLayers($city);

        // pick a starting position for each ward
        $this->setStartingPositions($city);

        // once all wards have a start position, loop through them all and place a square
        $this->allocateWards($city);

        // set up cells array with wards and empty spaces information in preparation for walls
        $this->loadCells($city);

        // determine which cells have walls on which sides
        $this->addWalls($city);
    }

    /**
     * determine height/width of the city and create unused_squares array of point indexes
     * @param City $city
     */
	private function createCellLayout(City $city)
	{
		// get the average density of building types for the city's population type
		$densities = $this->services->table->getTableResultIndex(Table::POPULATION_WARD_DENSITY, $city->populationType);
		$averageWardDensity = array_sum(array_values($densities)) / count($densities);

		// get the total cells for all the wards
        $buildingCounts = array_map(
            function (CityWard $ward) use ($averageWardDensity) {
                return $ward->numberCells = intval(max(1, intval(count($ward->buildings) / $averageWardDensity)) * RandomLayoutService::WARD_BLOAT_FACTOR);
            },
            $city->wards
        );

        // add some bloat to number of cells (ie "* 1.05") for the edges and inconsistencies and ward holes
        $this->layoutMeta->numCells = array_reduce( $buildingCounts, function ($total, $count) { return $total + $count; }, 0) * 1.05;

		// get random ratio (weighted towards .5) for determining height vs width
		// this determines the root to use when dividing cells
		// for a square city, # of cells in height or width = sqroot of total cells, doing different roots gives different shapes
        // if min/max ratios change, make sure to test against Layout_CityMapClass::WARD_BLOAT_FACTOR
		$ratio = $this->services->random->randMinMaxFloat('Layout: Height/Width ratio', new MinMax(.45, .55));

		// get height/width to be a rectangle
        $this->layoutMeta->height = max(1, intval(pow($this->layoutMeta->numCells, $ratio)));
        $this->layoutMeta->width = max(1, intval($this->layoutMeta->numCells / $this->layoutMeta->height));
        while ($this->layoutMeta->width * $this->layoutMeta->height < $this->layoutMeta->numCells) {
			// alternate
			if (($this->layoutMeta->width + $this->layoutMeta->height) % 2) {
                $this->layoutMeta->width++;
			} else {
                $this->layoutMeta->height++;
			}
		}

		// num_cells will most likely be a bit bigger now than originally intended which is ok, allows more filler
        $this->layoutMeta->numCells = $this->layoutMeta->width * $this->layoutMeta->height;

		// setup unused squares array
        $this->layoutMeta->unusedSquares = range(0, $this->layoutMeta->numCells - 1, 1);
	}

    /**
     * setup the layers of starting points for wards
     * @param City $city
     */
	private function setupLayers(City $city)
	{
		$wards_count = count($city->wards);

		$layers_count = 0;
		$layer_size = 4;
		while ($wards_count > 0) {
			$layers_count++;
			$wards_count -= $layer_size;
			$layer_size += 8;
		}
		// dots across = layers * 2; add two for margin with outside
		$square_step_x = $this->layoutMeta->width / ($layers_count * 2 + 1);
		$square_step_y = $this->layoutMeta->numCells / ($layers_count * 2 + 1);
		for ($level_number = 0; $level_number < $layers_count; $level_number++) {
			// move to level_number
			$cell_start_x = floor($square_step_x * ($layers_count - $level_number));
			$cell_start_y = floor($square_step_y * ($layers_count - $level_number));
			$layer = array();
			for ($x_pos = 0; $x_pos < ($level_number + 1) * 2; $x_pos++) {
				// fill whole row for first and last rows
				if ($x_pos == 0 || $x_pos == ($level_number + 1) * 2 - 1) {
					for ($y_pos = 0; $y_pos < ($level_number + 1) * 2; $y_pos++) {
						$layer[] = $this->position_to_point($cell_start_x + floor($square_step_x * $x_pos), floor($cell_start_y + $square_step_y * $y_pos));
					}
					// remember corners of outside layer
					if ($level_number == $layers_count - 1) {
                        $this->layoutMeta->startLocationsCorners[] = $this->position_to_point($cell_start_x + floor($square_step_x * $x_pos), $cell_start_y);
                        $this->layoutMeta->startLocationsCorners[] = $this->position_to_point($cell_start_x + floor($square_step_x * $x_pos), floor($cell_start_y + $square_step_y * (($level_number) * 2 + 1)));
					}
				} else {
					// only border cells for middle rows
					$layer[] = $this->position_to_point($cell_start_x + floor($square_step_x * $x_pos), $cell_start_y);
					$layer[] = $this->position_to_point($cell_start_x + floor($square_step_x * $x_pos), floor($cell_start_y + $square_step_y * (($level_number) * 2 + 1)));
				}
			}
            $this->layoutMeta->startingLocations[] = $layer;
		}
	}

    /**
	 * convert x/y point to a index position in the city grid
	 * @param int $x
	 * @param int $y
	 * @return int square index
	 */
	private function position_to_point($x, $y)
	{
		return $y * $this->layoutMeta->width + $x;
	}

    /**
     * set starting positions for every ward
     * @param City $city
     */
    private function setStartingPositions(City $city)
    {

        // place ward starting points in the city
        // - seas & outskirts (go in the corners)
        foreach ($city->wards as $ward) {
            if ($ward->type == Ward::SEA) {
                $point = $this->getStartingPoint(false, true);
                // add starting position to the ward
                $ward->addMapPosition($point, $this->layoutMeta);
            }
        }

        // - non-sea, non-outskirt, non-gate (gates go in the middle layers)
        foreach ($city->wards as $ward) {
            if ($ward->type != Ward::SEA && $ward->type != Ward::GATE) {
                $point = $this->getStartingPoint($ward->insideWalls, false);
                $ward->addMapPosition($point, $this->layoutMeta);
            }
        }

        // - gates
        foreach ($city->wards as $ward) {
            if ($ward->type == Ward::GATE) {
                $point = $this->getStartingPoint(false, false);
                $ward->addMapPosition($point, $this->layoutMeta);
            }
        }
    }


	/**
	 * get a point from layered started points
	 *
	 * @param $inside_walls true if the ward should be inside walls (placed in inner layers)
	 * @param $corner true if the ward should be in a corner (outter layer corner); this trumps inside_walls
	 * @return integer point of the starting position
	 */
	private function getStartingPoint($inside_walls, $corner)
	{
		if ($corner) {
			// randomize corners just for kicks
			shuffle($this->layoutMeta->startLocationsCorners);
			// get a random corner
			$point = array_shift($this->layoutMeta->startLocationsCorners);
			// remove corner from layers
			$layer = &$this->layoutMeta->startingLocations[count($this->layoutMeta->startingLocations) - 1];
			$idx = array_search($point, $layer);
			unset($layer[$idx]);
			// if layer is exhausted (tiny all ocean city?) remove layer
			if (count($layer) == 0) {
				array_pop($this->layoutMeta->startingLocations);
			}
		} else {
			// outside walls start on edges
			if ($inside_walls) {
				$layer_idx = 0;
			} else {
				// inside walls start in center
				$layer_idx = count($this->layoutMeta->startingLocations) - 1;
			}
			// get layer
			$layer = &$this->layoutMeta->startingLocations[$layer_idx];
			shuffle($layer);
			// get point
			$point = array_shift($layer);
			// remove layer if it's empty
			if (count($layer) == 0) {
				if ($inside_walls) {
					array_shift($this->layoutMeta->startingLocations);
				} else {
					array_pop($this->layoutMeta->startingLocations);
				}
			}
		}

		// remove from unused squares
		$idx = array_search($point, $this->layoutMeta->unusedSquares);
		unset($this->layoutMeta->unusedSquares[$idx]);

		return $point;
	}

    /**
     * once all wards have a start position, loop through them all and place a square
     * @param City $city
     */
	private function allocateWards(City $city)
	{
		do {
			$continue = false;
			foreach ($city->wards as $ward) {
				$continue = $ward->addLayoutSquare($this->layoutMeta) || $continue;
			}
		} while ($continue);
	}

    /**
     * load cells array with all the wards positions and empty positions as Layout_CellClass
     * also create ward lookup by id array
     * @param City $city
     */
	private function loadCells(City $city)
	{
		// easy lookup of ward by id for wall detection
		foreach ($city->wards as $ward) {
			$this->layoutMeta->wardsById[$ward->id] = $ward;

			// load cell positions
			foreach ($ward->getMapPositions() as $position) {
                $city->layoutCells[$position] = new LayoutCell($ward->id, $ward->insideWalls);
			}
		}

		foreach ($this->layoutMeta->unusedSquares as $position) {
            $city->layoutCells[$position] = new LayoutCell(null, null);
		}
	}


    /**
     * set walled status on all unclaimed cells and set wall sides on all walled cells bordering unwalled
     * @param City $city
     */
	private function addWalls(City $city)
	{
		// phase 1 : determine inside/outside
		// loop through and find any positions that aren't resolved
		foreach ($city->layoutCells as $idx => $cell) {
			// find unclaimed cells and set their walled status
			if ($cell->insideWalls === null) {
				$this->addWallsToUnclaimedClump($city, $idx);
			}
		}

		// phase 2 : find wall sides
		// loop through each position
		for ($i = 0; $i < $this->layoutMeta->numCells; $i++) {
			$cell = $city->layoutCells[$i];
			// only add walls to cells that are inside walls
			if ($cell->insideWalls) {
				// get neighbors to this cell
				$neighbors = $this->neighborSquares($i);
				// loop over possible sides so that cells on edge of layout still get walls
				foreach (array('left', 'top', 'right', 'bottom') as $side) {
					// if on border OR if adjacent cell is outside walls, add a wall for that side
					if (!isset($neighbors[$side]) || !$city->layoutCells[$neighbors[$side]]->inside_walls) {
						$cell->walls[$side] = true;
					}
				}
			}
		}
	}


    /**
     * find all adjacent cells that are unclaimed; if an adjacent cell is claimed and outside walls, all the cells are outside walls
     * @param City $city
     * @param int $idx starting point of an unclaimed cell
     */
	private function addWallsToUnclaimedClump(City $city, $idx)
	{
		$neighbors = array($idx);
		$inside_walls = true;
		for ($i = 0; $i < count($neighbors); $i++) {
			$new_neighbors = $this->neighborSquares($neighbors[$i]);
			// put clumps touching the border always outside walls
			if (count($new_neighbors) != 4) {
				$inside_walls = false;
			}
			// loop through neighbors looking for unclaimeds and outsiders
			foreach ($new_neighbors as $new_neighbor) {
			    if (!isset($city->layoutCells[$new_neighbor])) {
			        $city->layoutCells[$new_neighbor] = new LayoutCell(null, null);
                }
                $neighbor_cell = $city->layoutCells[$new_neighbor];
                // only add new neighbor if it is unclaimed
                if (array_search($new_neighbor, $neighbors) === false) {
                    // if neighbor is unwalled, the whole thing is unwalled
                    if ($neighbor_cell->insideWalls === false) {
                        $inside_walls = false;
                    } else if ($neighbor_cell->insideWalls === null) {
                        // neighbor is unclaimed so add to neighbors to lookup
                        $neighbors[] = $new_neighbor;
                    }
                    // else if neighbor_cell->inside_walls === true then inside_walls remains default true
                }
			}
		}
		// set the whole group's walled status
		foreach ($neighbors as $neighbor) {
			$city->layoutCells[$neighbor]->inside_walls = $inside_walls;
		}
	}



	/**
	 * find neighbor cells to the given point
	 *
	 * @param $point int number index in to city layout
	 * @return array of integers indexes in to city layout that are adjacent to this point
	 */
	public function neighborSquares($point)
	{
		// check adjacent squares to point to see if they should be added to possible positions
		$possible_points = array();
		// up = $point - width; ok to be negative, it will be disallowed later
		$temp = $point - $this->layoutMeta->width;
		if ($temp >= 0) {
			$possible_points['top'] = $temp;
		}
		// down = $point + width; ok to be off edge of map, it will be disallowed later
		$temp = $point + $this->layoutMeta->width;
		if ($temp < $this->layoutMeta->numCells) {
			$possible_points['bottom'] = $temp;
		}
		// left = $point - 1; watch for edges
		if ($point % $this->layoutMeta->width != 0) {
			$possible_points['left'] = $point - 1;
		}
		// right = $point +1; watch for edges
		if (($point + 1) % $this->layoutMeta->width != 0) {
			$possible_points['right'] = $point + 1;
		}
		return $possible_points;
	}

}
