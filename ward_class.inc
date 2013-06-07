<?php
class ward_class {
	public static $id_next = 0;
	public $type = '';
	public $acres = 0;
	public $inside_walls = false;
	public $buildings = array();
	public $building_total = 0;
	public $id = false;

	public function __construct() {
		$this->id = ++ward_class::$id_next;
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
			$key .= " : " . $sub_type;
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
