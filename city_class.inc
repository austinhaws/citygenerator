<?php
	require_once('global.inc');

class city_class {
	public $population_size = 0;
	public $population_type = '';
	public $name = '';
	public $num_structures = 0;
	public $population_density = 0.0;
	public $acres = 0.0;
	public $has = array(
		kHas_Military => false,
		kHas_Sea => false,
		kHas_River => false,
		);
	public $gates = 0;
	public $wards = array();
	public $professions = array();
	public $power_centers = array();
	public $influence_points_unabsorbed = 0;
	public $races = array();
	public $guilds = array();
	public $commodities = array('export' => array(), 'import' => array());
	public $famous = array('famous' => array(), 'infamous' => array());
	public $majority_race;

	public function __construct() {
	}

        private function random_famous_fill($num, $type) {
            global $table_famous;
            while ($num > 0) {
                $result = get_table_result_range($table_famous, rand_range(1, 4250));

                if (false === array_search($result, $this->famous[$type])) {
                    $this->famous[$type][] = $result;
                    --$num;
                }
            }
        }

        private function random_famous() {
            global $table_famous_occurrence;
            $min_max = $table_famous_occurrence[$this->population_type];

            $num = rand_range($min_max[kMin], $min_max[kMax]);
            $this->random_famous_fill($num, 'famous');
            sort($this->famous['famous']);

            $num = rand_range($min_max[kMin], $min_max[kMax]);
            $this->random_famous_fill($num, 'infamous');
            sort($this->famous['infamous']);
         }

	private function random_commodities_fill($num, $type) {
		global $table_commodities;
		while ($num > 0) {
			$result = get_table_result_range($table_commodities, rand_range(1, 3700));
			$found = false;
			// make it unique across all types
			foreach ($this->commodities as $values) {
				if (false !== array_search($result, $values)) {
					$found = true;
				}
			}
			if (!$found) {
				$this->commodities[$type][] = $result;
				--$num;
			}
		}
	}

	private function random_commodities() {
		global $table_commodity_count;
		$min_max = $table_commodity_count[$this->population_type];

		$num = rand_range($min_max[kMin], $min_max[kMax]);
		$this->random_commodities_fill($num, 'export');
		sort($this->commodities['export']);

		$num = rand_range($min_max[kMin], $min_max[kMax]);
		$this->random_commodities_fill($num, 'import');
		sort($this->commodities['import']);
	}

	private function random_population_type() {
		global $table_population_type;

		$this->population_type = get_table_result_range($table_population_type, rand_range(1, 100));
	}

	private function random_acres() {
		global $table_population_acres;
		$value = get_table_result_index($table_population_acres, $this->population_type);
		$this->acres = $this->population_size / rand_ratio_range($value[kMin], $value[kMax]);
	}

	private function random_num_structures() {
		global $table_population_num_structures;
		$value = get_table_result_index($table_population_num_structures, $this->population_type);

		$this->num_structures = $this->acres / rand_ratio_range($value[kMin], $value[kMax]);
	}

	private function random_population_size() {
		global $table_population_size;
		$value = get_table_result_index($table_population_size, $this->population_type);
		$this->population_size = rand_range($value[kMin], $value[kMax]);
	}

	private function random_gates() {
		global $table_population_has_walls;
		global $table_population_num_walls;
		$has_walls = get_table_result_index($table_population_has_walls, $this->population_type);
		if ($has_walls != 0 && rand_range(1, 100) <= $has_walls) {
			$num_gates = get_table_result_index($table_population_num_walls, $this->population_type);
			$this->gates = rand_range($num_gates[kMin], $num_gates[kMax]);
		} else {
			$this->gates = 0;
		}
	}

	private function random_wards($generate_buildings, $post) {
		global $table_wards;

		$ward_count = array();
		foreach ($table_wards as $ward) {
			$ward_count[$ward] = 0;
		}

		$acres = $this->acres;
		$required_wards = $this->gates +
			($this->has[kHas_Sea] ? 1 : 0) +
			($this->has[kHas_River] ? 1 : 0) +
			($this->has[kHas_Military] ? 1 : 0) +
			($this->is_size_atleast(kPopulationType_SmallTown) ? 1 : 0) +
			($this->is_size_atleast(kPopulationType_SmallCity) ? 1 : 0) +
			($this->is_size_atleast(kPopulationType_Metropolis) ? 1 : 0) +
			2;

		// put in wards the user requested
		foreach ($post['wards-added'] as $ward_added) {
			$this->add_ward($ward_added->ward, $acres, $this->gates > 0, $ward_count, $generate_buildings, $ward_added->buildings);
		}


		// put in wards
		for ($i = 1; $i <= $this->gates; ++$i) {
			$temp = $acres / $required_wards;
			$acres -= $this->add_ward(kWard_Gate, $temp, true, $ward_count, $generate_buildings);
		}

		if ($this->has[kHas_Sea]) {
			$temp = $acres / $required_wards;
			$acres -= $this->add_ward(kWard_Sea, $temp, $this->gates > 0 && rand_range(1, 100) < 50, $ward_count, $generate_buildings);
		}

		if ($this->has[kHas_River]) {
			$temp = $acres / $required_wards;
			$acres -= $this->add_ward(kWard_River, $temp, $this->gates > 0 && rand_range(1, 100) < 50, $ward_count, $generate_buildings);
		}

		if ($this->has[kHas_Military]) {
			$temp = $acres / $required_wards;
			$acres -= $this->add_ward(kWard_Military, $temp, $this->gates > 0, $ward_count, $generate_buildings);
		}

		if ($this->is_size_atleast(kPopulationType_SmallTown)) {
			$temp = $acres / $required_wards;
			$acres -= $this->add_ward(kWard_Administration, $temp, $this->gates > 0, $ward_count, $generate_buildings);
		}

		if ($this->is_size_atleast(kPopulationType_SmallCity)) {
			$temp = $acres / $required_wards;
			$acres -= $this->add_ward(kWard_Craftsmen, $temp, $this->gates > 0, $ward_count, $generate_buildings);
		}

		if ($this->is_size_atleast(kPopulationType_Metropolis)) {
			$temp = $acres / $required_wards;
			$acres -= $this->add_ward(kWard_Patriciate, $temp, $this->gates > 0, $ward_count, $generate_buildings);
		}

		$temp = $acres / $required_wards;
		$acres -= $this->add_ward(kWard_Market, $temp, $this->gates > 0, $ward_count, $generate_buildings);

		$temp = $acres / $required_wards;
		$acres -= $this->add_ward(kWard_Merchant, $temp, $this->gates > 0, $ward_count, $generate_buildings);

		// fill up acres with wards
		while ($acres > 0) {
			//	ward	1-10 (1 = not common)	range	X >= rand (d100);
			//----------------------------------------------------------------------------------------
			// ---- 25 % -----
			//Patriciate	1	1	1
			//Administration	2	10	11
			//Sea	3	2	13
			//River	4	3	16
			//Odiferous	5	9	25
			// ---- 75% ----
			//Shanty	6	5	30
			//Slums	7	10	40
			//Merchant	8	15	55
			//Market	9	20	75
			//Craftsmen	10	25	100

			$rand = rand_range(1, 100);
			if ($rand <= 1) {
				if ($this->is_size_atleast(kPopulationType_SmallCity) && $ward_count[kWard_Patriciate] == 0) {
					// only one administration ward
					// always inside the walls
					$this->add_ward(kWard_Patriciate, $acres, $this->gates > 0, $ward_count, $generate_buildings);
				}
			} elseif ($rand <= 11) {
				if ($this->is_size_atleast(kPopulationType_SmallCity) && $ward_count[kWard_Administration] == 0) {
					//only one administration ward
					// always inside the walls
					$this->add_ward(kWard_Administration, $acres, $this->gates > 0, $ward_count, $generate_buildings);
				}

			} elseif ($rand <= 13) {
				if ($this->has[kHas_Sea]) {
					$this->add_ward(kWard_Sea, $acres, $this->gates > 0 && rand_range(1, 100) < 50, $ward_count, $generate_buildings);
				}

			} elseif ($rand <= 16) {
				if ($this->has[kHas_River]) {
					$this->add_ward(kWard_River, $acres, $this->gates > 0 && rand_range(1, 100) < 50, $ward_count, $generate_buildings);
				}

			} elseif ($rand <= 25) {
				$this->add_ward(kWard_Oderiforous, $acres, $this->gates > 0 && rand_range(1, 100) < 5, $ward_count, $generate_buildings);

			} elseif ($rand <= 30) {
				if ($this->is_size_atleast(kPopulationType_SmallCity)) {
					// outside the walls
					$this->add_ward(kWard_Shanty, $acres, false, $ward_count, $generate_buildings);
				}
			} elseif ($rand <= 40) {
				if ($this->is_size_atleast(kPopulationType_SmallCity)) {
					// outside the walls
					$this->add_ward(kWard_Slum, $acres, $this->gates > 0, $ward_count, $generate_buildings);
				}
			} elseif ($rand <= 55) {
				//  inside walls
				// one merchant ward in town unless metropolis
				if ($this->is_size_atleast(kPopulationType_Metropolis) || $ward_count[kWard_Craftsmen] == 0) {
					$this->add_ward(kWard_Merchant, $acres, $this->gates > 0, $ward_count, $generate_buildings);
				}
			} elseif ($rand <= 75) {
				// mostly inside walls
				$this->add_ward(kWard_Market, $acres, $this->gates > 0 && rand_range(1, 100) < 83, $ward_count, $generate_buildings);

			} elseif ($rand <= 100) {
				// most common ward within city walls
				// more than one ward possible in large towns or larger
				// mostly inside city walls
				if ($this->is_size_atleast(kPopulationType_SmallCity)
					&& (($this->is_size_atleast(kPopulationType_LargeTown) && $ward_count[kWard_Craftsmen] <= 1)
						Or $this->is_size_atleast(kPopulationType_Metropolis))) {
					$this->add_ward(kWard_Craftsmen, $acres, $this->gates > 0 && rand_range(1, 100) < 90, $ward_count, $generate_buildings);
				}
			} else {
				pprint_r($rand, "Oops. rand out of range : " + $rand, true);
			}
		}
	}

	private function is_size_atleast($population_type) {
		global $table_is_size_atleast;
		$goods = get_table_result_index($table_is_size_atleast, $population_type);
		return (false !== array_search($this->population_type, $goods));
	}

	private function random_buildings($ward, $building_weights) {
		global $table_buildings;
		global $table_buildings_subtypes;
		global $table_population_ward_density;
		$value = get_table_result_index($table_population_ward_density[$this->population_type], $ward->type);

		$density = max(1, $value * $ward->acres);

		for ($i = 1; $i <= $density; ++$i) {
			if ($building_weights) {
				$total_weights = 0;
				for ($k = count($building_weights) - 1; $k >= 0; $k--) {
					$total_weights += $building_weights[$k]->weight;
				}

				$rand = rand_range(1, $total_weights);
				for ($j = count($building_weights) - 1; $rand > 0 && $j >= 0;) {
					$rand -= $building_weights[$j]->weight;
					$j--;
				}
				$j++;

//pprint_r($table_buildings[$building_weights[$j]->type], 'table buildings');
//pprint_r(array($j, $total_weights, $building_weights), 'select from these', true);
				$buildings_list = $table_buildings[$ward->type];
				$building_type = $building_weights[$j]->type;
				$result = false;
				foreach ($buildings_list as $building_item) {
					if ($building_item['type'] == $building_type) {
						$result = $building_item;
						break;
					}
				}
				if (!$result) {
					$result = $building_item[array_shift(array_keys($building_item))]; // default to first on list if no match (this shouldn't be possible)
				}
			} else {
				$result = get_table_result_range($table_buildings[$ward->type], rand_range(1, 100));
			}
			$type = $result['type'];
			$quality = rand_range($result[kMin], $result[kMax]);

			if (isset($table_buildings_subtypes[$type])) {
				$subtype = get_table_result_range($table_buildings_subtypes[$type], rand_range(1, 1000));
			} else {
				$subtype = '';
			}

			$ward->add_building($type, $subtype, $quality);
		}
	}

	function add_ward($ward_type, &$acres_left, $inside_walls, &$ward_count, $generate_buildings, $building_weights = false) {
		global $table_ward_acres_used;
		// based on city type, should allocate bigger/smaller randomness in sizes
		$value = get_table_result_index($table_ward_acres_used, $this->population_type);

		$acres_used = rand_ratio_range($value[kMin], $value[kMax]);
		if ($acres_left - $acres_used < 0) {
			$acres_used = $acres_left;
			$acres_left = 0;
		} else {
			$acres_left -= $acres_used;
		}

		$ward = new ward_class();
		$ward->type = $ward_type;
		$ward->acres = $acres_used;
		$ward->inside_walls = $inside_walls;
		if ($generate_buildings) {
			$this->random_buildings($ward, $building_weights);
		}

		$this->wards[] = $ward;
		initialize_array_value($ward_count, $ward->type, 0);
		$ward_count[$ward->type]++;

		return $acres_used;
	}

	private function random_profession_single() {
		global $table_profession;
		$profession = get_table_result_range($table_profession, rand_range(1, 10000));

		$this->add_profession($profession, 1);
	}

	private function add_profession($profession, $num) {
		if ($num > 0) {
			initialize_array_value($this->professions, $profession, 0);
			$this->professions[$profession] += $num;
		}
	}

	private function random_professions() {
		global $table_profession_ratio;
		$total = 0;
		// add automatic ratioed professions
		foreach ($table_profession_ratio as $profession => $ratio) {
			$num = intval(floatval($this->population_size) / floatval($ratio));
			$this->add_profession($profession, $num);
			$total += $num;
		}

		// for all population not accounted for in ratioed, do random single load
		while ($total < $this->population_size) {
			++$total;
			$this->random_profession_single();
		}
		ksort($this->professions);
	}

	public function random($post) {
		// population type
		if (is_random($post['population_type'])) {
			$this->random_population_type();
		} else {
			$this->population_type = $post['population_type'];
		}

		// population size
		$this->random_population_size();
		$this->random_acres();
		$this->random_num_structures();

		// sea, river, military, gates
		if (!isset($post['sea']) || is_random($post['sea'])) {
			$this->random_sea();
		} else {
			$this->has[kHas_Sea] = isset($post['sea']) && $post['sea'];
		}
		if (!isset($post['river']) || is_random($post['river'])) {
			$this->random_river();
		} else {
			$this->has[kHas_River] = isset($post['river']) && $post['river'];
		}
		if (!isset($post['military']) || is_random($post['military'])) {
			$this->random_military();
		} else {
			$this->has[kHas_Military] = isset($post['military']) && $post['military'];
		}
		if (!isset($post['gates']) || is_random($post['gates'])) {
			$this->random_gates();
		} else {
			$this->gates = $post['gates'];
		}

		// wards
		$this->random_wards(isset($post['buildings']), $_POST);

		// professions
		if (isset($post['professions']) && $post['professions']) {
			$this->random_professions();
		}

		$this->random_power_centers();
		$this->random_races($post);
		$this->random_guilds();
		$this->random_commodities();
        $this->random_famous();

		if ($post['name']) {
			$this->name = $post['name'];
		} else {
			$this->random_name();
		}
	}

	private function random_guilds() {
		global $table_guilds;
		global $table_guild_modifiers;

		$modifier = get_table_result_index($table_guild_modifiers, $this->population_type);
		$modifier = 50 + rand_range($modifier['min'], $modifier['max']);

		// loop through each guild
		foreach ($table_guilds as $guild => $professions) {
			// count up number of $this->professions for each guild profession from table
			$count = 0;
			foreach ($professions as $profession) {
				if (isset($this->professions[$profession])) {
					$count += $this->professions[$profession];
				}
				// divide by 50 +/- offset to get # of guilds of this type in this city
			}
			$this->guilds[$guild] = floor($count / $modifier);
		}
	}

	private function random_races($post) {
		global $table_races;
		global $table_integration;
		global $table_races_percents;
		global $table_races_random;

		$mix = (is_random($post['racial_mix']) ? get_table_result_index($table_integration, rand_range(1, 3)) : $post['racial_mix']);

		$races = array();
		if (is_random($post['race'])) {
			$this->majority_race = get_table_result_range($table_races_random, rand_range(1, 100));
		} else {
			$this->majority_race = $post['race'];
		}

		$count = 0;
		$this->races[$this->majority_race] = floor(get_table_result_index($table_races_percents[$mix], $count++) * $this->population_size);
		$total = $this->races[$this->majority_race];
		foreach ($table_races as $race) {
			if ($race != $this->majority_race) {
				$this->races[$race] = floor(get_table_result_index($table_races_percents[$mix], $count++) * $this->population_size);
				$total += $this->races[$race];
			}
		}
		$this->races[$this->majority_race] += $this->population_size - $total;
	}

	public function output_races() {
		$parts = array();
		foreach ($this->races as $race => $amount) {
			if ($amount) {
				$parts[] = $race . ' (' . output_integer($amount) . ')';
			}
		}
		return implode($parts, '; ');
	}

	private function random_sea() {
		$this->has[kHas_Sea] = rand_range(1, 100) <= 33;
	}

	private function random_river() {
		$this->has[kHas_River] = rand_range(1, 100) <= 33;
	}

	private function random_military() {
		global $table_population_military;
		$this->has[kHas_Military] = rand(1, 100) <= get_table_result_range($table_population_military, $this->population_type);
	}

	public function show_profession_counts() {
		$kColumns = 5;
		$output = '<table class="table_professions table_center"><thead /><tbody><tr>';

		$count = 0;
		foreach ($this->professions as $key => $value) {
			++$count;

			$output .= '<td>' . $key . ' : ' . $value . '</td>';

			if ($count % $kColumns == 0) {
				$output .= '</tr><tr>';
			}
		}

		return $output . '</tr></tbody></table>';
	}

	public function wealth() {
		return (doubleval($this->gold_piece_limit()) * 0.5) * (doubleval($this->population_size) * 0.1);
	}

	public function gold_piece_limit() {
		global $table_population_wealth;
		return get_table_result_index($table_population_wealth, $this->population_type);
	}

	public function king_income() {
		global $table_king_income;
		$value = get_table_result_index($table_king_income, $this->population_type);

		return $value * $this->wealth();
	}

	public function magic_resources() {
		global $table_magic_resources;
		$value = get_table_result_index($table_magic_resources, $this->population_type);
		return $value * $this->wealth();
	}

	private function random_power_centers() {
		global $table_population_power_center;
		global $table_population_influence_points;
		global $table_population_power_center_modifier;
		global $table_power_center_type;
		global $table_power_center_unabsorbed;

		$value = get_table_result_index($table_population_power_center, $this->population_type);
		$count = rand_range($value[kMin], $value[kMax]);

		if ($count) {
			$value = get_table_result_index($table_population_influence_points, $this->population_type);
			$influence_points = rand_range($value[kMin], $value[kMax]);

			$percent = get_table_result_index($table_power_center_unabsorbed, $this->population_type);

			$this->influence_points_unabsorbed = $influence_points * $percent;
			$influence_points -= $this->influence_points_unabsorbed;
			$total_influence_points = $influence_points;

			$average_influence = $influence_points / $count;
			$offset_influence = $average_influence / 10.0;

//			$modifier = get_table_result_index($table_population_power_center_modifier, $this->population_type);

			for ($i = 0; $i < $count; ++$i) {
				$type = get_table_result_range($table_power_center_type, rand_range(1, 1000));

				if ($i == $count) {
					// use the remainder of points
					$influence = $influence_points;
				} else {
					// get random amount based on range of possibles
					$influence = rand($average_influence - $offset_influence, $average_influence + $offset_influence);
					$influence_points = $influence_points - $influence;
				}

				// power center's wealth is a matching ratio of city's wealth to influence points percentage
				$ratio = $influence / $total_influence_points;
				$wealth = $ratio * $this->wealth();

				// nonstandard has a 5% chance of being monstrous
				$this->power_centers[] = new power_center_class($type, $influence, $wealth, $count, $this);
			}
		}
	}

	public function random_name() {
		global $table_syllables, $table_name_num_words, $table_name_num_syllables;

		// do conversion to other languages using dictionary
		switch ($this->majority_race) {
			case kRace_Elf:
				$dictionary = 'Elf';
				break;

			case kRace_Gnome:
			case kRace_Dwarf:
				$dictionary = 'Goblin';
				break;

			case kRace_HalfElf:
				// split 50/50 human or elf
				if (rand_range(1, 100) > 50) {
					$dictionary = 'Elf';
				} else {
					$dictionary = '';
				}
				break;

			case kRace_HalfOrc:
				// split 50/50 orc or elf
				if (rand_range(1, 100) > 50) {
					$dictionary = 'Tolkien Black Speech';
				} else {
					$dictionary = '';
				}
				break;

			case kRace_Halfling:
			case kRace_Human:
			case kRace_Other:
				$dictionary = '';
				break;

			default:
				exit('Oops, bad majority race: ' . $this->majority_race);
		}

		if (!$dictionary && rand_range(1, 100) > 50) {
			global $table_name_prefixes, $table_name_suffixes, $table_name_words, $table_name_words_count;

			$parts = array();
			$count = get_table_result_range($table_name_num_words, rand_range(1, 100));
			while ($count-- > 0) {
				// each word has the possibility of being one or two words combined
				if (rand_range(1, 100) > 75) {
					$part = get_table_result_random($table_name_words) . get_table_result_random($table_name_words);
				} else {
					$part = get_table_result_random($table_name_words);
				}
				if (rand_range(1, 100) > 90) {
					$part = get_table_result_random($table_name_prefixes) . $part;
				}
				if (rand_range(1, 100) > 90) {
					$part .= get_table_result_random($table_name_suffixes);
				}
				$parts[] = $part;
			}
			$this->name = implode(' ', $parts);

		} else {
			$num_words = get_table_result_range($table_name_num_words, rand_range(1, 100));
			for ($i = 0; $i < $num_words; ++$i) {
					$parts = array();
					$num_syllables = get_table_result_range($table_name_num_syllables, rand_range(1, 55));
					for ($j = 0; $j < $num_syllables; ++$j) {
							$parts[] = get_table_result_range($table_syllables, rand_range(1, 650));
					}
					if ($this->name) {
							$this->name .= ' ';
					}
					$this->name .= implode('', $parts);
			}
			if ($dictionary) {
				$content = file_get_contents("http://www.crystalballsoft.com/dictionary/remote.php?dictionary=" . urlencode($dictionary) . '&shuffle=0&text=' . urlencode($this->name));
				$content = mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
				$this->name =  $content;
			}
		}

		$this->name = ucwords($this->name);
	}

	public function show_power_centers(&$div_names) {
		$output = '';
		$i = 0;
		foreach ($this->power_centers as $power_center) {
			$output .= $power_center->show($div_names, $i++);
			$output .= '<br />';
		}
		return $output;
	}

	public function show_guilds_table() {
		$kColumns = 5;

		$output = '<table class="table_guilds table_center"><thead /><tbody><tr>';

		$count = 0;
		foreach ($this->guilds as $name => $num) {
			if ($num) {
				++$count;

				$output .= '<td><span class="guild_name">' . $name . '</span> : <span class="guild_num">' . $num . '</span></td>';

				if ($count % $kColumns == 0) {
					$output .= '</tr><tr>';
				}
			}
		}

		$output .= '</tr></tbody></table>';

		return $output;
	}

	public function guilds_count() {
		$total = 0;
		foreach ($this->guilds as $num) {
			$total += $num;
		}
		return $total;
	}
}
