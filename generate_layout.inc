<?
	require_once('global.inc');

	define('SQUARES_PER_ACRE', 1);


	class Layout_CellClass {
		public $ward_id = false; // pointer to the ward that is claiming this space
		public $walls = array('left' => false, 'right' => false, 'top' => false, 'bottom' => false,);
		public $touches_outside = false; // if true, then this cell can be connected to outside the city and is not an island in the wards

		public function wardId() {
			return $this->ward_id;
		}

		public function setWard(&$ward) {
			$this->ward_id = $ward->id;
		}
	}

	class Layout_CityMapClass {
		public $array_size = 0; // how many cells so that you don't have to do count($this->cells) all the time
		public $width = false; // how many map cells in width
		public $height = false; // how many map cells in height
		public $cells = array(); // array of Layout_CellClass that is in a 2-d array (have to convert idx <==> (x, y)
		public $average_density = false; // the average density of the ctytype; could be a table value since it's static
		private $city = false; // the city used for generation // keep private so that json doesn't get an infinite loop

		public function generate($city) {
			// save the city for all to cherish
			$this->city = $city;

			// create the cells array of the right size and determine height/width of layout
			$this->create_cell_layout();

			// add edging blank zones to give a rugged edge to the city
			$this->add_edging();

			// place the wards in the city
			$this->add_wards();

			// determine which cells have walls on which sides
			$this->add_walls();
		}

		private function add_walls() {
			$directions = array( // the directions to test for neighbors
				'left' => array('x' => -1), // left
				'right' => array('x' => 1), // right
				'top' => array('y' => -1), // up
				'bottom' => array('y' => 1), // down
			);
			$ward_lookups = array();
			foreach ($this->city->wards as $ward) {
				$ward_lookups[$ward->id] = $ward;
			}

			// for all unused cells, find if they an island in wards or if they touch the outside
			do {
				$found = false;
				// loop through all cells and if the cell is next to a cell that touches the outside or is on the outside, set outside flag
				for ($i = 0; $i < $this->array_size; $i++) {
					// if already claimed or already determined, skip it
					if (($this->cells[$i]->ward_id === false || $ward_lookups[$this->cells[$i]->ward_id]->type == Layout_Enum_Wards::kWard_Outskirt) && !$this->cells[$i]->touches_outside) {
						$position = $this->idx_to_position($i);
						if ($position['x'] == 0 || $position['y'] == 0 || $position['x'] == $this->width - 1 || $position['y'] == $this->height - 1) {
							$this->cells[$i]->touches_outside = true;
							$found = true;
						} else {
							$offset_position = $position;
							foreach ($directions as $which_side => $direction) {
								foreach ($direction as $axis => $delta) {
									// check neighbors
									$offset_position[$axis] += $delta;
								}

								$idx = $this->coord_to_array_pos($offset_position);
								if ($idx >= 0) {
									// if any neighbor touches_outside then this cell touches outside
									$test_cell = $this->cells[$idx];
									if ($test_cell->touches_outside || ($test_cell->ward_id && !$ward_lookups[$test_cell->ward_id]->inside_walls)) {
										$this->cells[$i]->touches_outside = true;
										$found = true; // mark that one was found
									}
								}

								$offset_position = $position; // reset offset position
							}
						}
					}
				}
				// keep looping until no more found
			} while ($found);
			// at this point, all cells that are unclaimed and don't have "touches outside" marked are "islands" and should not have walls on them


			// for each cell, determine which sides have walls
			// to have a wall, the current cell must be inside_walls and the cell adjacent to it on the side being tested must be outside walls
			// for now, not claimed cells count as neither inside nor outside so that no walls are placed by them

			$ward_lookup = array(); // key = ward_id, value = ward
			foreach ($this->city->wards as $ward) {
				$ward_lookup[$ward->id] = $ward;
			}

			$position = array('x' => 0, 'y' => 0);// the starting position
			// loop until all cells have been visited
			while ($position['x'] < $this->width && $position['y'] < $this->height) {
				$myidx = $this->coord_to_array_pos($position);
				$my_cell = $this->cell($position);
				if ($my_cell->ward_id !== false) {
					$my_ward = $ward_lookup[$my_cell->ward_id];

					if ($my_ward->inside_walls) {
						$offset_position = $position;
						// offset the cell position to check neighbors
						foreach ($directions as $which_side => $direction) {
							foreach ($direction as $axis => $delta) {
								$offset_position[$axis] += $delta;
							}

							// test offset
							$idx = $this->coord_to_array_pos($offset_position);
							$needs_wall = false;
							if ($idx >= 0) {
								$cell = $this->cells[$idx];
								if ($cell->ward_id === false) {
									$needs_wall = $cell->touches_outside;
								} else {
									$offset_ward = $ward_lookup[$cell->ward_id];
									$needs_wall = $offset_ward->inside_walls != $my_ward->inside_walls;
								}
							} else if ($my_ward->inside_walls) {
								$needs_wall = true;
							}
							$this->cells[$myidx]->walls[$which_side] = $needs_wall;

							$offset_position = $position; // reset position
						}
					}
				}
				if (++$position['x'] >= $this->width) {
					$position['y']++;
					$position['x'] = 0;
				}
			}
		}

		private function add_wards() {
			// create list of unclaimed cells for easier finding starting places
			$unclaimed_cells = array(); // key = array position string, value = pointer to the cell
			$unclaimed_cells_edges = array();
			for ($i = 0; $i < $this->array_size; $i++) {
				if ($this->cells[$i]->ward_id === false) {
					$unclaimed_cells[$this->idx_to_position_string($i)] =& $this->cells[$i];
					$position = $this->idx_to_position($i);
					if ($position['x'] == 0 || $position['x'] == $this->width - 1 || $position['y'] == 0 || $position['y'] == $this->height - 1) {
						$unclaimed_cells_edges[$this->idx_to_position_string($i)] =& $this->cells[$i];
					}
				}
			}
//pprint_r($unclaimed_cells_edges, 'unclaimed cells edges', true);
//pprint_r($unclaimed_cells, 'unclaimed cells', true);

			// treat inside_walls as true/false doing false state first
			// 0 (first) : outside; 1 (second) : gates; 2 (third) : everything else
			for ($current_ward_type = 0; $current_ward_type < 3; $current_ward_type++) {
				for ($i = count($this->city->wards) - 1; $i >= 0; $i--) {
					$ward =& $this->city->wards[$i];
					// do wards outside of walls first and start them on the edge of the city
					$matches = false;
					switch ($current_ward_type) {
						case 0: // outside walls
							$matches = !$ward->inside_walls;
						break;
						case 1: // gates
							$matches = $ward->type == Layout_Enum_Wards::kWard_Gate;
						break;
						case 2: // inside walls
							$matches = ($ward->type != Layout_Enum_Wards::kWard_Gate) && $ward->inside_walls;
						break;
						default:
							pprint_r($current_ward_type, 'Unknown current ward type', true);
						break;
					}
					if ($matches) {
						if ((!$ward->inside_walls || $ward->type == Layout_Enum_Wards::kWard_Gate) && $unclaimed_cells_edges) {
							$use_array =& $unclaimed_cells_edges;
						} else {
							// adding cell inside walls or there are no more wall spaces available
							$use_array =& $unclaimed_cells;
						}

						// pick an empty cell
//						do {
							// if didn't fit, then pick a new empty cell to start at that wasn't in the list of cells from the last check
							$pos = rand_range(0, count($use_array) - 1);
							$place = array_keys($use_array)[$pos];

						// LATER: detect if there are enough cells to fit the ward (short circuit once a big enough size has been proven)
						// if no big enough space left on the map, then just pick the biggest place left and plop in the ward
//						} while (!$this->does_ward_fit($ward->number_cells, $place, $unclaimed_cells));

						// run algorithm to place ward
						$state = array(
							'positions' => array($this->idx_string_to_position($place)),
							'total_size' => $ward->number_cells,
							'current_size' => 0,
						);
						$this->layout_ward($state, $ward);

						// remove ward's cells from unclaimed_cells_edges and unclaimed_cells
						for ($j = 0; $j < $this->array_size; $j++) {
							$j_string = $this->idx_to_position_string($j);
							$cell = $this->cells[$j];
							if ($cell->ward_id == $ward->id) {
								unset($unclaimed_cells[$j_string]);
								unset($unclaimed_cells_edges[$j_string]);
							}
						}
//pprint_r(array('inside walls' => $inside_walls, 'i' => $i, $ward), 'placing ward', true);
					}
				}
			}
			// wash, rinse, repeat


			// after all wards have claimed their space, find an empty cell, pick a ward from the cells adjacent to this cell to which to add this cell
			$unclaimed = array();
			for ($i = 0; $i < $this->array_size; $i++) {
				if ($this->cells[$i]->ward_id === false) {
					$unclaimed[$this->idx_to_position_string($i)] = array(
						'position' => $this->idx_to_position($i),
						'cell' => &$this->cells[$i],
					);
				}
			}
// skip claiming
/*			// claim all the unclaimeds
			// - get all outskirt wards so that they can't be grown
			$outskirt_wards = array();
			foreach ($this->city->wards as $ward) {
				if ($ward->type == Layout_Enum_Wards::kWard_Outskirt) {
					$outskirt_wards[] = $ward->id;
				}
			}
			$directions = array(
				array('x' => -1), // left
				array('x' => 1), // right
				array('y' => -1), // up
				array('y' => 1), // down
			);
			while ($unclaimed) {
				$keys = array_keys($unclaimed);
				$key = $keys[rand_range(0, count($keys) - 1)]; // randomly select an unclaimed cell
				$position = $unclaimed[$key]['position'];

				// check all four directions from this point to find wards touching this cell
				$possibles = array();
				$total_weights = 0; // the total found # possibles
				foreach ($directions as $direction) {
					// just use the same position object to keep from creating a bunch of overhead
					foreach ($direction as $axis => $delta) {
						$position[$axis] += $delta;
					}
					// make sure it's not trying to go over edge boundaries
					if ($position['x'] >= 0 && $position['x'] < $this->width && $position['y'] >= 0 && $position['y'] < $this->height) {
						// test if the cell is available
						$cell = $this->cell($position);
		//pprint_r(array('position' => $position, 'cell' => $cell), 'testing position');
						if ($cell && ($ward_id = $cell->wardId()) && false === array_search($ward_id, $outskirt_wards)) {
							if (!isset($possibles[$ward_id])) {
								$possibles[$ward_id] = 1;
							} else {
								$possibles[$ward_id]++;
							}
							$total_weights++;
						}
					}

					// put position back to what it was
					foreach ($direction as $axis => $delta) {
						$position[$axis] -= $delta;
					}
				}

				// if this neighbors a ward, randomly pick a neighbor and add to that neighbor
				if ($total_weights) {
					$result = rand_range(1, $total_weights);
					foreach ($possibles as $ward_id => $count) {
						$result -= $count;
						if ($result <= 0) {
							// put in this ward id!
							$unclaimed[$key]['cell']->ward_id = $ward_id;
							// unset this possible
							unset($unclaimed[$key]);
							break;
						}
					}
				}
			}
*/
		}

		private function add_edging() {
			// round edges (if there is enough space to allow it)
			if ($this->array_size > 100) {
				$num_edges = intval($this->average_density);
				$edges = array(
					array('x' => 0, 'y' => 0), // - top left
					array('x' => 0, 'y' => $this->height - 1), // - bottom left
					array('x' => $this->width - 1, 'y' => $this->height - 1), // - bottom right
					array('x' => $this->width - 1, 'y' => 0), // - top right
				);
				// wow, this seems incredibly unoptimized
				// - remove edges to make it the size of num edges
				while ($num_edges < count($edges)) {
					unset($edges[rand_range(0, count($edges) - 1)]);
					$edges = array_values($edges);
				}
				/* to do: add more edges based on num_edges*/

				foreach ($edges as $edge) {
					$state = array(
						'positions' => array($edge),
						'total_size' => rand_range(5, 10),
						'current_size' => 0,
					);

					$ward = new ward_class();
					$ward->type = Layout_Enum_Wards::kWard_Outskirt;
					$ward->show_ward_list = false;
					$this->city->wards[] = $ward;

					$this->layout_ward($state, $ward);
				}
			}

		}

		private function create_cell_layout() {
			global $table_population_ward_density;

			$this->average_density = 0;

			// get the average density of building types for the city's population type
			$densities = $table_population_ward_density[$this->city->population_type];
			foreach ($densities as $density) {
				$this->average_density += $density;
			}
			$this->average_density /= count($densities);

			// get the total buildings for all the wards
			$num_cells = 0;
			foreach ($this->city->wards as $ward) {
				$ward->number_cells = max(1, intval($ward->building_total / $this->average_density));
				$num_cells += $ward->number_cells;
			}

			$num_cells *= 1.25; // add some bloat for the edges and inconsistencies and ward holes

			// get random ratio (weighted towards .5) for determining height vs width
			// this determines the root to use when dividing cells
			// for a square city, # of cells in height or width = sqroot of total cells, doing different roots gives different shapes
			do {
				// loop until the ratio isn't impossibly bad
				$ratio = rand_ratio();
			} while ($ratio > .55 || $ratio < .45);

			// get height/width to be a rectangle
			$this->height = max(1, intval(pow($num_cells, $ratio)));
			$this->width = max(1, intval($num_cells / $this->height));

			while ($this->width * $this->height < $num_cells) {
				if (($this->width + $this->height) % 2) { // alternate
					$this->width++;
				} else {
					$this->height++;
				}
			}
			// num_cells will most likely be a bit bigger now than originally intended which is ok, needs more filler
			$num_cells = $this->width * $this->height;
// pprint_r(array(
// 	'height' => $this->height,
// 	'width' => $this->width,
// 	'num_cells' => $num_cells,
// 	'density' => $this->average_density,
// 	'ratio' => $ratio
// ), 'num cells');

			// load cells array with cellclass objects
			for ($i = 0; $i < $num_cells; $i++) {
				$this->cells[] = new Layout_CellClass();
			}
			$this->array_size = $num_cells; // for quick looping not requiring count() every time
		}

		// input: array idx
		// output: string key of array position (x:y)
		public function idx_to_position_string($idx) {
			$position = $this->idx_to_position($idx);
			return $position['x'] . ':' . $position['y'];
		}

		// input: array idx
		// output: array('x' => $x, 'y' => $y)
		public function idx_to_position($idx) {
			$y = intval($idx / $this->width);
			$x = $idx - $y * $this->width;
			return array('x' => $x, 'y' => $y);
		}

		// input : position array
		// output : idx
		public function coord_to_array_pos($position) {
			if ($position['x'] < 0 || $position['y'] < 0 || $position['x'] >= $this->width || $position['y'] >= $this->height) {
				$retval = -1;
			} else {
				$retval = $position['y'] * $this->width + $position['x'];
			}
			return $retval;
		}

		public function &cell($position) {
			$idx = $this->coord_to_array_pos($position);
			if ($idx >= 0 && $idx < $this->array_size) {
				return $this->cells[$idx];
			}
			$false = false; // ya, ugg...
			return $false;
		}

		public function setCell($position, &$cell) {
			$this->cells[$this->coord_to_array_pos($position)] =& $cell;
		}

		// input: position array
		// output: x:y
		public function position_to_idx($position) {
			return $position['x'] . ':' . $position['y'];
		}

		// input: x:y
		// output: position array
		public function idx_string_to_position($position_idx) {
			list($x, $y) = explode(':', $position_idx);
			return array('x' => $x, 'y' => $y);
		}

		public function load_possibles($position, &$possibles, &$total_weights) {
//pprint_r(array($position, $possibles), 'starting position');
			// load up directions to go arrays (this allows for diaganols easily later on)
			$directions = array(
				array('x' => -1), // left
				array('x' => 1), // right
				array('y' => -1), // up
				array('y' => 1), // down
			);
			// check all four directions from this point
			foreach ($directions as $direction) {
				// just use the same position object to keep from creating a bunch of overhead
				foreach ($direction as $axis => $delta) {
					$position[$axis] += $delta;
				}
				// make sure it's not trying to go over edge boundaries
				if ($position['x'] >= 0 && $position['x'] < $this->width && $position['y'] >= 0 && $position['y'] < $this->height) {
					// test if the cell is available
					$cell = $this->cell($position);
	//pprint_r(array('position' => $position, 'cell' => $cell), 'testing position');
					if ($cell && !$cell->wardId()) {
						$idx = $this->position_to_idx($position);
						if (!isset($possibles[$idx])) {
							$possibles[$idx] = 0;
						}
						$possibles[$idx]++;
						$total_weights++;
					}
				}

				// put position back to what it was
				foreach ($direction as $axis => $delta) {
					$position[$axis] -= $delta;
				}
			}
//pprint_r(array($position, $possibles), 'ending position');
		}

		/*
			$state = array(
				positions => array({x: coordinate x, y: coordinate y}, ...) // the order of the positions taken so far, for recursion
				total_size => how many cells to consume
				current_size => how many cells consumed so far
			);
		*/
		public function layout_ward(&$state, $ward) {

			$possibles = array(); // the possible cells to select from that are adjacent to an already placed cell
			$total_weights = 0; // weights of all the possibles (kept in a variable so it doesn't have to be recalculated each time)

			// set start position as claimed by this ward
			$cell = $this->cell($state['positions'][0]);
			if ($cell && !$cell->wardId()) {
				$cell->setWard($ward);
				$this->load_possibles($state['positions'][0], $possibles, $total_weights);
				$state['current_size']++;
			}

			// doing it this way automatically weights cells closer to start more since they have more opportunities to be picked
			// the weight of the next choice is based on how many cells are next to it
			// loop until total_size reached or run out of possibles
			while (count($possibles) && $state['total_size'] > $state['current_size']) {
				// pick a cell from the list: rand_range(0, total_weights)
				$rand = rand_range(1, $total_weights);
//pprint_r(array('rand' => $rand, 'weights' => $total_weights), 'blah');
				$found = false;
				foreach ($possibles as $cell_position_key => $weight) {
					$rand -= $weight;
					if ($rand <= 0) {
						$found = $cell_position_key;
						break;
					}
				}
//pprint_r(array('found' => $found, 'rand' => $rand, 'weights' => $total_weights), 'blah');
				if ($found === false) {
					pprint_r($possibles, 'unable to find a random item in this possibles list', true);
				}
//pprint_r($found, 'found');
				// claim the cell
				$position = $this->idx_string_to_position($found);
				$cell = $this->cell($position);
				if (!$cell || $cell->wardId()) {
					// sanity check
					pprint_r(array('cell' => $cell, 'position' => $position), 'already claimed!', true);
				}
				$cell->setWard($ward);

				// get one step closer to filling the ward
				$state['current_size']++;

				// remove it from the possibles list
				$total_weights -= $possibles[$found];
				unset($possibles[$found]);

				// add a count for claimed cell's unclaimed neighbors to the list
				$this->load_possibles($position, $possibles, $total_weights);

				// eventually, will want to limit max x/y movement by passed in parameters for these values to make different shapes
			}
		}
	}
