<?php
class ward_class {
	public $type = '';
	public $acres = 0;
	public $inside_walls = false;
	public $buildings = array();

	public function __construct() {
	}
	public function __destruct() {
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
		if (!isset($this->buildings[$key])) {
			$this->buildings[$key] = 0;
		}
		$this->buildings[$key]++;
	}

	public function get_building_total() {
		$total = 0;
		foreach ($this->buildings as $sum) {
			$total += $sum;
		}
		return $total;
	}

	public function show_building_table() {
		$kColumns = 5;

		$output = '<table class="table_buildings"><thead /><tbody><tr>';

		$count = 0;
		ksort($this->buildings);
		foreach ($this->buildings as $name => $num) {
			++$count;

			$output .= '<td><span class="building_name">' . $name . '</span> : <span class="building_num">' . $num . '</span></td>';

			if ($count % $kColumns == 0) {
				$output .= '</tr><tr>';
			}
		}

		$output .= '</tr></tbody></table>';

		return $output;
	}
}
