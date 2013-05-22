<?php
class power_center_class {
	public $type = '';
	public $alignment = '';
	public $wealth = 0;
	public $npcs = array();
	public $influence_points;

	public function __construct($type, $influence, $wealth, $num_centers, $city) {
		$this->type = $type;
		$this->wealth = $wealth;
		$this->influence_points = $influence;

		$this->random_alignment();

		$this->random_npcs($num_centers, $city);
	}

	private function random_alignment() {
		global $table_power_center_alignment;

		$this->alignment = get_table_result_range($table_power_center_alignment, rand_range(1, 100));
	}

	private function random_npcs($num_centers, $city) {
		/*
		• do class / level looping/rund own for each power center
		• each class/level slot only has a 1 in # power centers chance of generating npcs of the given level

		• this will divide the total number of npcs across the # of power centers and will give each
		power center a differing splatter of npcs yet could allow multiple power centers to have the
		same spattering

		• it will also make sure that all the possible influence points for the center are used for the center
		*/
		global $table_npc_level_modifiers;
		global $table_npc_classes_max_level;
		global $table_class_influence;
		global $table_class_random_class;

		$modifier = get_table_result_index($table_npc_level_modifiers, $city->population_type);

		$influence_left = $this->influence_points;
		$not_used_count = 0; // how many times it failed to add (usually because it picked something too expensive)

		while ($influence_left && $not_used_count < 5) {
			// randomly pick a class
			$class = get_table_result_range($table_class_random_class, rand_range(1, 1000));
			// randomly pick level
			$max_level = get_table_result_index($table_npc_classes_max_level, $class) + $modifier;
			$max_level = max(0, min(20, $max_level + rand_range(0, 1)));

			$num = 1;
			$not_used_for = true;
			for ($level = rand_range(1, $max_level); $level > 0; ) {
				$influence_cost = get_table_result_index($table_class_influence, $class);

				$not_used = true;
				while ($num >= 1 && $not_used) {
					if (0 > $influence_left - ($influence_cost * $level * $num)) {
						--$num;
					} else {
						$influence_left -= get_table_result_index($table_class_influence, $class) * $level * $num;
						if (!isset($this->npcs[$class])) {
							$this->npcs[$class] = array();
						}
						if (!isset($this->npcs[$class][$level])) {
							$this->npcs[$class][$level] = 0;
						}
						$this->npcs[$class][$level] += $num;
						$not_used = false;
						$not_used_for = false;
					}
				}
				$num = max($num * 2, 1);

				if ($level == 1) {
					$level = 0;
				} else {
					$level = intval($level / 2) + ($level % 2) + (rand_range(1, 10) == 1 ? 1 : 0);
				}
			}
			if ($not_used_for) {
				++$not_used_count;
			}
		}
		ksort($this->npcs);
	}

	public function number_npcs() {
		$total = 0;
		foreach ($this->npcs as $class => $data) {
			foreach ($data as $level => $number) {
				$total += $number;
			}
		}
		return $total;
	}

	private function show_npcs() {
		$kColumns = 5;
		$output = '<table id="power_centers" class="table_npcs table_center">';

		$output .= '<thead>';
		$output .= '<th />';
		$output .= '<th>1</th>';
		$output .= '<th>2</th>';
		$output .= '<th>3</th>';
		$output .= '<th>4</th>';
		$output .= '<th>5</th>';
		$output .= '<th>6</th>';
		$output .= '<th>7</th>';
		$output .= '<th>8</th>';
		$output .= '<th>9</th>';
		$output .= '<th>10</th>';
		$output .= '<th>11</th>';
		$output .= '<th>12</th>';
		$output .= '<th>13</th>';
		$output .= '<th>14</th>';
		$output .= '<th>15</th>';
		$output .= '<th>16</th>';
		$output .= '<th>17</th>';
		$output .= '<th>18</th>';
		$output .= '<th>19</th>';
		$output .= '<th>20</th>';
		$output .= '</thead><tbody><tr>';

		$count = 0;
		foreach ($this->npcs as $class => $data) {
			$counts = array();
			foreach ($data as $level => $amount) {
				$counts[$level] = $amount;
			}
			$output .= '<tr><td>' . $class . '</td>';

			for ($i = 1; $i <= 20; ++$i) {
				$output .= '<td class="table_data">' . (isset($counts[$i]) ? $counts[$i] : '-') . '</td>';
			}
			$output .= '</tr>';
		}
		return $output . '</tr></tbody></table>';
	}

	public function show(&$div_names, $i) {
		$div_names[] = 'power_center_' . $i;
		$output = '';
		$output .= table_center_begin();
		$output .= '<br />';
		$output .= '<div class="power_center_type"><a href="#" rel="toggle[power_center_' . $i . ']">' . $this->type . '</a></div>';
		$output .= '<br />';
//		$output .= '<span class="field_title">Type:</span>' . $this->type . '<br />';
		$output .= '<div id="power_center_' . $i . '">';
		$output .= table_center_begin();
		$output .= '<span class="field_title">Alignment:</span>' . $this->alignment . '<br />';
		$output .= '<span class="field_title">Wealth:</span>' . output_double($this->wealth) . '<br />';
		$output .= '<span class="field_title">Influence Points:</span>' . output_integer($this->influence_points) . '<br />';
		$output .= '<span class="field_title">Total NPCs:</span>' . output_integer($this->number_npcs()) . '<br />';
		$output .= table_center_end();
		$output .= '<br />';
		$output .= $this->show_npcs();
		$output .= '</div>';
		$output .= table_center_end();

		return $output;
	}
}
