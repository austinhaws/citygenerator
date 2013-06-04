<?
	require_once('global.inc');

	define('SQUARES_PER_ACRE', 1);

	class Layout_CellClass {
		public $ward_id = false; // pointer to the ward that is claiming this space

		public function wardId() {
			return $this->ward_id;
		}

		public function setWard(&$ward) {
			$this->ward_id = $ward->id();
		}
	}

	class Layout_CityMapClass {
		public $array_size = 0; // how many cells so that you don't have to do count($this->cells) all the time
		public $width = false;
		public $height = false;
		public $wards = array();
		public $cells = array(); // array of Layout_CellClass that is in a 2-d array (have to convert idx <==> (x, y)

		public function generate($city) {
//(new Layout_CityMapClass_Test())->test();

			// get random ratio (weighted towards .5) for determining height vs width
			$ratio = rand_ratio();
			$this->height = $city->acres * $ratio;
			$this->width = $city->acres - $this->height;

			$this->height = intval($this->height * SQUARES_PER_ACRE);
			$this->width = intval($this->width * SQUARES_PER_ACRE);

			// load cells array with cellclass objects
			for ($i = $this->height * $this->width - 1; $i >= 0; $i--) {
				$this->cells[] = new Layout_CellClass();
			}
			$this->array_size = count($this->cells); // for quick looping not requiring count() every time


			// round edges
			$state = array(
				'positions' => array(array('x' => 0, 'y' => 0)),
				'total_size' => rand_range(5, 10),
				'current_size' => 0,
			);
			$this->layout_ward($state, Layout_Enum_Wards::kWard_Outskirt);
//pprint_r($this, 'layout city map class');
		}

		public function coord_to_array_pos($position) {
			if ($position['x'] < 0 || $position['y'] < 0) {
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

		// index in a key/value array where x:y is the key
		public function position_to_idx($position) {
			return $position['x'] . ':' . $position['y'];
		}
		public function idx_to_position($position_idx) {
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

				// test if the cell is available
				$cell = $this->cell($position);
//pprint_r(array('position' => $position, 'cell' => $cell), 'testing position');
				if ($cell && !$cell->wardId()) {
					$idx = $this->position_to_idx($position);
					if (!isset($possibles[$this->position_to_idx($position)])) {
						$possibles[$this->position_to_idx($position)] = 0;
					}
					$possibles[$this->position_to_idx($position)]++;
					$total_weights++;
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
		public function layout_ward(&$state, $ward_type) {
			$ward = new Layout_WardClass($ward_type);
			$this->wards[] =& $ward;

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
				$position = $this->idx_to_position($found);
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

	class Layout_WardClass {
		public $type = false; // the name/type of the ward use kWard_... constants
		public $id = false;
		private static $next_id = 0; // idx for uniquely identifying wards

		public function __construct($type) {
			$this->id = ++self::$next_id;
			$this->type = $type;
		}

		public function id() {
			return $this->id;
		}
	}


	interface Layout_Enum_Wards {
		const kWard_Outskirt = kWard_Outskirt;
	}

	class Layout_CityMapClass_Test extends Layout_CityMapClass {
		public function test() {
			$this->test_coord_to_array_pos();
			$this->test_position_to_idx();
			$this->test_idx_to_position();
		}

		private function test_position_to_idx() {
			assert('1:3' == $this->position_to_idx(array('x' => 1, 'y' => 3)));
		}
		private function test_idx_to_position() {
			assert(array('x' => 1, 'y' => 3) == $this->idx_to_position('1:3'));
		}


		private function test_coord_to_array_pos() {
			$this->width = 9;
			$this->height = 7;

			for ($y = 0; $y < $this->height; $y++) {
				for ($x = 0; $x < $this->width; $x++) {
					$position = array('x' => $x, 'y' => $y);
					assert($y * $this->width + $x == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with : ' . $this->coord_to_array_pos($position));
				}
			}

			$position = array('x' => -1, 'y' => 0);
			assert(-1 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with : ' . $this->coord_to_array_pos($position));

			$position = array('x' => 0, 'y' => -1);
			assert(-1 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with : ' . $this->coord_to_array_pos($position));

			$position = array('x' => 0, 'y' => 0);
			assert(0 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with : ' . $this->coord_to_array_pos($position));

			for ($i = 1; $i < 9; $i++) {
				$position = array('x' => $i, 'y' => 0);
				assert($i == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with : ' . $this->coord_to_array_pos($position));
			}
			for ($i = 1; $i < 9; $i++) {
				$position = array('x' => $i, 'y' => 1);
				assert($i + $this->width == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with : ' . $this->coord_to_array_pos($position));
			}

			$position = array('x' => 0, 'y' => 1);
			assert(9 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with ' . $this->coord_to_array_pos($position));

			$position = array('x' => 0, 'y' => 2);
			assert(18 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with ' . $this->coord_to_array_pos($position));

			$position = array('x' => 0, 'y' => 3);
			assert(27 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with ' . $this->coord_to_array_pos($position));

			$position = array('x' => 0, 'y' => 4);
			assert(36 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with ' . $this->coord_to_array_pos($position));

			$position = array('x' => 0, 'y' => 5);
			assert(45 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with ' . $this->coord_to_array_pos($position));

			$position = array('x' => 0, 'y' => 6);
			assert(54 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with ' . $this->coord_to_array_pos($position));

			$position = array('x' => 8, 'y' => 6);
			assert(62 == $this->coord_to_array_pos($position), $position['x'] . ':' . $position['y'] . ' failed with ' . $this->coord_to_array_pos($position));

			exit('test complete');
		}
	}


/*


XXXXXXXXXX
XXXXXXXXXX
XXXXXXXXXX
XXXXXXXXXX
XXXXXXXXXX


*/
