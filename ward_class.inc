<?php
class ward_class {
	public $type = '';
	public $acres = 0;
	public $inside_walls = false;
	public $buildings = array();
	public $building_total = 0;



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
			$this->buildings[] = array('key' => $key, 'total' => 0);
			$found = &$this->buildings[count($this->buildings) - 1];
		}
		$found['total']++;
		$this->building_total++;
	}

	public function show_building_table() {
		$kColumns = 5;

		$output = '<table class="table_buildings"><thead /><tbody><tr>';

		$count = 0;
		//ksort($this->buildings);
		foreach ($this->buildings as $building) {
			++$count;

			$output .= '<td><span class="building_name">' . $building['key'] . '</span> : <span class="building_num">' . $building['total'] . '</span></td>';

			if ($count % $kColumns == 0) {
				$output .= '</tr><tr>';
			}
		}

		$output .= '</tr></tbody></table>';

		return $output;
	}
}
