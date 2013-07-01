<?
	interface Layout_Enum_Wards {
		const kWard_Administration = kWard_Administration;
		const kWard_Craftsmen = kWard_Craftsmen;
		const kWard_Gate = kWard_Gate;
		const kWard_Market = kWard_Market;
		const kWard_Merchant = kWard_Merchant;
		const kWard_Military = kWard_Military;
		const kWard_Oderiforous = kWard_Oderiforous;
		const kWard_Outskirt = kWard_Outskirt;
		const kWard_Patriciate = kWard_Patriciate;
		const kWard_River = kWard_River;
		const kWard_Sea = kWard_Sea;
		const kWard_Shanty = kWard_Shanty;
		const kWard_Slum = kWard_Slum;
	}

	class ward_class {
		public static $id_next = 0;
		private $type = '';
		public $type_public = ''; // for json
		public $acres = 0;
		public $inside_walls = false;
		public $buildings = array();
		public $building_total = 0;
		public $id = false;
		public $number_cells = 0; // how many cells this ward consumes (set by layout class)
		public $layout = false;
		public $id_letter = false; // unique letter given to each ward
		public $letter = false; // letter based on ward type(may be a dup)
		private static $next_letter = 'a'; // similar to index, give each ward its own letter
		public $show_ward_list = true; // this is a natural ward that should be shown in the ward list; outskirt wards are not in this category

		public function __construct() {
			$this->id = ++ward_class::$id_next;
			$this->id_letter = self::$next_letter;

			// go to the next letter
			if (self::$next_letter == 'z') {
				self::$next_letter = 'A';
			} else if (self::$next_letter == 'Z') {
				self::$next_letter = '0';
			} else if (self::$next_letter == '9') {
				// now what?
				self::$next_letter = chr(ord(self::$next_letter) + 1);
				// exit('too many wards...');
			} else {
				self::$next_letter++;
			}
		}

		public function setType($type) {
			$this->type = $type;

			switch ($this->type) {
				case Layout_Enum_Wards::kWard_Administration:
					$this->letter = 'A';
				break;
				case Layout_Enum_Wards::kWard_Craftsmen:
					$this->letter = 'C';
				break;
				case Layout_Enum_Wards::kWard_Gate:
					$this->letter = 'G';
				break;
				case Layout_Enum_Wards::kWard_Market:
					$this->letter = 'M';
				break;
				case Layout_Enum_Wards::kWard_Merchant:
					$this->letter = '$';
				break;
				case Layout_Enum_Wards::kWard_Military:
					$this->letter = 'Y';
				break;
				case Layout_Enum_Wards::kWard_Oderiforous:
					$this->letter = 'O';
				break;
				case Layout_Enum_Wards::kWard_Outskirt:
					$this->letter = ' ';
				break;
				case Layout_Enum_Wards::kWard_Patriciate:
					$this->letter = 'P';
				break;
				case Layout_Enum_Wards::kWard_River:
					$this->letter = 'R';
				break;
				case Layout_Enum_Wards::kWard_Sea:
					$this->letter = 'W'; //water
				break;
				case Layout_Enum_Wards::kWard_Shanty:
					$this->letter = 'S';
				break;
				case Layout_Enum_Wards::kWard_Slum:
					$this->letter = 'L';
				break;
				default:
				exit('unknown type: ' . $this->type);
			}
			$this->type_public = $this->type;
		}

		public function type() {
			return $this->type;
		}

		private function convert_quality($quality) {
			if (is_numeric($quality)) {
				switch ($quality) {
					case 1:	$quality = 'A'; break;
					case 2:	$quality = 'B'; break;
					case 3:	$quality = 'C'; break;
					case 4:	$quality = 'D'; break;
					default:
						pprint_r($quality, 'Unknown quality', true);
						break;
				}
			}
			return $quality;
		}

		public function add_building($type, $sub_type, $quality) {
			$key = $type;
			if ($sub_type) {
				$key .= ":" . $sub_type;
			}
			$key .= " (" . $this->convert_quality($quality) . ")";
			$found = false;
			foreach ($this->buildings as $key_loop => $value) {
				if ($value['key'] == $key) {
					$found = &$this->buildings[$key_loop];
					break;
				}
			}
			if (!$found) {
				$this->buildings[] = array('key' => $key, 'total' => 1);
			} else {
				$found['total']++;
			}
			$this->building_total++;
		}

		public function cleanup() {
			usort($this->buildings, function($a, $b) {
				return strcmp($a['key'], $b['key']);
			});
		}
	}
