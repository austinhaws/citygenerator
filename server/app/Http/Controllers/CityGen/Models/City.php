<?php

namespace App\Http\Controllers\CityGen\Models;

class City {
	public $populationSize = false;
	public $populationType = false;
	public $name = '';
	public $numStructures = 0;
	public $population_density = 0.0;
	public $acres = 0.0;
	public $hasSea = false;
	public $hasMilitary = false;
	public $hasRiver = false;
	// todo rename to numGates
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
//	public $layout = new Layout_CityMapClass();

	// outputs for json (sorry, hacky)
	public $races_output = false; // the races formatted for output
	public $gold_piece_limit_output = false;
	public $wealth_output = false;
	public $king_income_output = false;
	public $magic_resources_output = false;
	public $commodities_export = false;
	public $commodities_import = false;
	public $famous_famous = false;
	public $famous_infamous = false;
	public $buildings_total = false;
	public $guilds_count = 0;

//	public function generate_map() {
//		$this->layout->generate($this);
//	}

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
		$min_max = $table_famous_occurrence[$this->populationType];

		$num = rand_range($min_max[MinMax::MIN], $min_max[kMax]);
		$this->random_famous_fill($num, 'famous');
		sort($this->famous['famous']);

		$num = rand_range($min_max[MinMax::MIN], $min_max[kMax]);
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
		$min_max = $table_commodity_count[$this->populationType];

		$num = rand_range($min_max[MinMax::MIN], $min_max[kMax]);
		$this->random_commodities_fill($num, 'export');
		sort($this->commodities['export']);

		$num = rand_range($min_max[MinMax::MIN], $min_max[kMax]);
		$this->random_commodities_fill($num, 'import');
		sort($this->commodities['import']);
	}


	private function random_populationSize() {
		global $table_population_size;
		// check if it was hand entered so already set
		if ($this->populationSize === false) {
			$value = get_table_result_index($table_population_size, $this->populationType);
			$this->populationSize = rand_range($value[MinMax::MIN], $value[kMax]);
		}
	}

	private function random_wards($generate_buildings, $post) {
		global $table_wards;

		$ward_count = array();
		foreach ($table_wards as $ward) {
			$ward_count[$ward] = 0;
		}

		$acres = $this->acres;
		$has_gates = $this->gates > 0;
		$required_wards = $this->gates +
			($this->has[kHas_Sea] ? 1 : 0) +
			($this->has[kHas_River] ? 1 : 0) +
			($this->has[kHas_Military] ? 1 : 0) +
			($this->is_size_atleast(kPopulationType_SmallTown) ? 1 : 0) +
			($this->is_size_atleast(kPopulationType_SmallCity) ? 1 : 0) +
			($this->is_size_atleast(kPopulationType_Metropolis) ? 1 : 0) +
			2;

		// put in wards the user requested
		$already_done = array(
			kWard_Administration => false,
			kWard_Craftsmen => false,
			kWard_Gate => false,
			kWard_Market => false,
			kWard_Merchant => false,
			kWard_Military => false,
			kWard_Oderiforous => false,
			kWard_Patriciate => false,
			kWard_River => false,
			kWard_Sea => false,
			kWard_Shanty => false,
			kWard_Slum => false,
		);
		$num_gates = $this->gates;
		foreach ($post['wards-added'] as $ward_added) {
			switch ($ward_added->ward) {
				case kWard_Gate:
					if ($num_gates > 0) {
						$num_gates--;
					} else {
						$this->gates++; // make sure the count is correct
					}
				break;
				default:
					$already_done[$ward_added->ward] = true; // don't have to do more of these wards because it's already done
				break;
				$required_wards = max(0, $required_wards - 1); // this ward consumes a spot
			}
		}
		$acres_per_ward = $acres / ($required_wards + count($post['wards-added']));

		foreach ($post['wards-added'] as $ward_added) {
			$acres -= $this->add_ward($ward_added->ward, $acres_per_ward, $has_gates, $ward_count, $generate_buildings);
		}

		// put in wards
		for ($i = 1; $i <= $num_gates; ++$i) {
			$acres -= $this->add_ward(kWard_Gate, $acres_per_ward, true, $ward_count, $generate_buildings);
		}

		if ($this->has[kHas_Sea] && !$already_done[kWard_Sea]) {
			$acres -= $this->add_ward(kWard_Sea, $acres_per_ward, $has_gates && rand_range(1, 100) < 50, $ward_count, $generate_buildings);
		}

		if ($this->has[kHas_River] && !$already_done[kWard_River]) {
			$acres -= $this->add_ward(kWard_River, $acres_per_ward, $has_gates && rand_range(1, 100) < 50, $ward_count, $generate_buildings);
		}

		if ($this->has[kHas_Military] && !$already_done[kWard_Military]) {
			$acres -= $this->add_ward(kWard_Military, $acres_per_ward, $has_gates, $ward_count, $generate_buildings);
		}

		if ($this->is_size_atleast(kPopulationType_SmallTown) && !$already_done[kWard_Administration]) {
			$acres -= $this->add_ward(kWard_Administration, $acres_per_ward, $has_gates, $ward_count, $generate_buildings);
		}

		if ($this->is_size_atleast(kPopulationType_SmallCity) && !$already_done[kWard_Craftsmen]) {
			$acres -= $this->add_ward(kWard_Craftsmen, $acres_per_ward, $has_gates, $ward_count, $generate_buildings);
		}

		if ($this->is_size_atleast(kPopulationType_Metropolis) && !$already_done[kWard_Patriciate]) {
			$acres -= $this->add_ward(kWard_Patriciate, $acres_per_ward, $has_gates, $ward_count, $generate_buildings);
		}

		if (!$already_done[kWard_Market]) {
			$acres -= $this->add_ward(kWard_Market, $acres_per_ward, $has_gates, $ward_count, $generate_buildings);
		}

		if (!$already_done[kWard_Merchant]) {
			$acres -= $this->add_ward(kWard_Merchant, $acres_per_ward, $has_gates, $ward_count, $generate_buildings);
		}

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
					$acres -= $this->add_ward(kWard_Patriciate, $acres, $has_gates, $ward_count, $generate_buildings);
				}
			} elseif ($rand <= 11) {
				if ($this->is_size_atleast(kPopulationType_SmallCity) && $ward_count[kWard_Administration] == 0) {
					//only one administration ward
					// always inside the walls
					$acres -= $this->add_ward(kWard_Administration, $acres, $has_gates, $ward_count, $generate_buildings);
				}

			} elseif ($rand <= 13) {
				if ($this->has[kHas_Sea]) {
					$sea_count = 0;
					foreach ($this->wards as $ward) {
						if ($ward->type() == kWard_Sea) {
							$sea_count++;
						}
					}
					// seas start in corners of city so don't allow more than 4
					if ($sea_count < 4) {
						$acres -= $this->add_ward(kWard_Sea, $acres, false, $ward_count, $generate_buildings);
					}
				}

			} elseif ($rand <= 16) {
				if ($this->has[kHas_River]) {
					$acres -= $this->add_ward(kWard_River, $acres, $has_gates && rand_range(1, 100) < 50, $ward_count, $generate_buildings);
				}

			} elseif ($rand <= 25) {
				$acres -= $this->add_ward(kWard_Oderiforous, $acres, $has_gates && rand_range(1, 100) < 5, $ward_count, $generate_buildings);

			} elseif ($rand <= 30) {
				if ($this->is_size_atleast(kPopulationType_SmallCity)) {
					// outside the walls
					$acres -= $this->add_ward(kWard_Shanty, $acres, false, $ward_count, $generate_buildings);
				}
			} elseif ($rand <= 40) {
				if ($this->is_size_atleast(kPopulationType_SmallCity)) {
					// outside the walls
					$acres -= $this->add_ward(kWard_Slum, $acres, $has_gates, $ward_count, $generate_buildings);
				}
			} elseif ($rand <= 55) {
				//  inside walls
				// one merchant ward in town unless metropolis
				if ($this->is_size_atleast(kPopulationType_Metropolis) || $ward_count[kWard_Merchant] == 0) {
					$acres -= $this->add_ward(kWard_Merchant, $acres, $has_gates, $ward_count, $generate_buildings);
				}
			} elseif ($rand <= 75) {
				// mostly inside walls
				$acres -= $this->add_ward(kWard_Market, $acres, $has_gates && rand_range(1, 100) < 83, $ward_count, $generate_buildings);

			} elseif ($rand <= 100) {
				// most common ward within city walls
				// more than one ward possible in large towns or larger
				// mostly inside city walls
				if ($this->is_size_atleast(kPopulationType_SmallCity)
					&& (($this->is_size_atleast(kPopulationType_LargeTown) && $ward_count[kWard_Craftsmen] <= 1)
						|| $this->is_size_atleast(kPopulationType_Metropolis))) {
					$acres -= $this->add_ward(kWard_Craftsmen, $acres, $has_gates && rand_range(1, 100) < 90, $ward_count, $generate_buildings);
				}
			} else {
				//pprint_r($rand, "Oops. rand out of range : " + $rand, true);
			}
		}

		foreach ($this->wards as $key => $ward) {
			$ward->cleanup();
		}
	}

	private function is_size_atleast($populationType) {
		global $table_is_size_atleast;
		$goods = get_table_result_index($table_is_size_atleast, $populationType);
		return (false !== array_search($this->populationType, $goods));
	}

	private function random_buildings($ward, $building_weights) {
		global $table_buildings;
		global $table_buildings_subtypes;
		global $table_population_ward_density;
		$value = get_table_result_index($table_population_ward_density[$this->populationType], $ward->type());

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
				$buildings_list = $table_buildings[$ward->type()];
				$building_type = $building_weights[$j]->type;
				$result = false;
				foreach ($buildings_list as $building_item) {
					if ($building_item['type'] == $building_type) {
						$result = $building_item;
						break;
					}
				}
				if (!$result) {
					$keys = array_keys($buildings_list);
					$result = $buildings_list[array_shift($keys)]; // default to first on list if no match (this shouldn't be possible)
				}
			} else {
				$result = get_table_result_range($table_buildings[$ward->type()], rand_range(1, 100));
			}
			$type = $result['type'];
			$quality = rand_range($result[MinMax::MIN], $result[kMax]);

			if (isset($table_buildings_subtypes[$type])) {
				$subtype = get_table_result_range($table_buildings_subtypes[$type], rand_range(1, 1000));
			} else {
				$subtype = '';
			}

			$ward->add_building($type, $subtype, $quality);
		}
	}

	function add_ward($ward_type, $acres_left, $inside_walls, &$ward_count, $generate_buildings, $building_weights = false) {
		global $table_ward_acres_used;
		// based on city type, should allocate bigger/smaller randomness in sizes
		$value = get_table_result_index($table_ward_acres_used, $this->populationType);

		$acres_used = rand_ratio_range($value[MinMax::MIN], $value[kMax]);
		if ($acres_left - $acres_used < 0) {
			$acres_used = $acres_left;
			$acres_left = 0;
		} else {
			$acres_left -= $acres_used;
		}

		$ward = new ward_class();
		$ward->setType($ward_type);
		$ward->acres = $acres_used;
		$ward->inside_walls = $inside_walls;
		if ($generate_buildings) {
			$this->random_buildings($ward, $building_weights);
		}

		$this->wards[] = $ward;
		initialize_array_value($ward_count, $ward->type(), 0);
		$ward_count[$ward->type()]++;

		return $acres_used;
	}

	private function random_profession_single() {
		global $table_profession;
		$profession = get_table_result_range($table_profession, rand_range(1, 10000));

		$this->add_profession($profession, 1);
	}

	private function add_profession($profession, $num) {
		if ($num > 0) {
			$found = false;
			foreach ($this->professions as $key => $profession_loop) {
				if ($profession_loop['profession'] == $profession) {
					$found =& $this->professions[$key];
					break;
				}
			}
			if ($found) {
				$found['total'] += $num;
			} else {
				$this->professions[] = array('profession' => $profession, 'total' => $num);
			}
		}
	}

	private function random_professions() {
		global $table_profession_ratio;
		$total = 0;
		// add automatic ratioed professions
		foreach ($table_profession_ratio as $profession => $ratio) {
			$num = intval(floatval($this->populationSize) / floatval($ratio));
			$this->add_profession($profession, $num);
			$total += $num;
		}

		// for all population not accounted for in ratioed, do random single load
		while ($total < $this->populationSize) {
			++$total;
			$this->random_profession_single();
		}
		usort($this->professions, function($a, $b) {
			return strcmp($a['profession'], $b['profession']);
		});
	}


	private function random_guilds() {
		global $table_guilds;
		global $table_guild_modifiers;

		$modifier = get_table_result_index($table_guild_modifiers, $this->populationType);
		$modifier = 50 + rand_range($modifier['min'], $modifier['max']);

		// loop through each guild
		foreach ($table_guilds as $guild => $professions) {
			// count up number of $this->professions for each guild profession from table
			$count = 0;
			foreach ($professions as $profession) {
				$found = false;
				foreach ($this->professions as $profession_loop) {
					if ($profession_loop['profession'] == $profession) {
						$found = $profession_loop;
						break;
					}
				}
				if ($found) {
					$count += $found['total'];
				}
				// divide by 50 +/- offset to get # of guilds of this type in this city
			}
			$number = floor($count / $modifier);
			if ($number) {
				$this->guilds_count += $number;
				$this->guilds[] = array('guild' => $guild, 'total' => $number);
			}
		}
	}

	private function random_races($post) {
		global $table_races;
		global $table_integration;
		global $table_races_percents;
		global $table_races_random;

		if ($post['racial_mix'] == 'Custom') {
			// create map of {race, value}
			$jsonArray = (array) json_decode($post['raceRatio']);
			$raceRatios = array_map(function ($race, $ratio) {
				return ['race' => $race, 'ratio' => floatval($ratio)];
			}, array_keys($jsonArray), $jsonArray);

			usort($raceRatios, function ($a, $b) {
				return $b['ratio'] - $a['ratio'];
			});

			$totalValues = array_reduce($raceRatios, function ($total, $raceRatio) {
				return $total + $raceRatio['ratio'];
			}, 0.0);

			if ($totalValues == 0) {
				$post['racial_mix'] = kRandom;
			} else {
				foreach ($raceRatios as $idx => $raceRatio) {
					$raceRatios[$idx]['ratio'] = $raceRatio['ratio'] / $totalValues;
				}
				$this->majority_race = $raceRatios[0]['race'];
			}
		}

		// if they didn't choose custom or they didn't choose sliders for custom
		if ($post['racial_mix'] != 'Custom') {
			$mix = (is_random($post['racial_mix']) ? get_table_result_index($table_integration, rand_range(1, 3)) : $post['racial_mix']);
			if (is_random($post['race'])) {
				$this->majority_race = get_table_result_range($table_races_random, rand_range(1, 100));
			} else {
				$this->majority_race = $post['race'];
			}

			// list of races with majority at top
			$races = [$this->majority_race];
			foreach ($table_races as $race) {
				if ($race != $this->majority_race) {
					$races[] = $race;
				}
			}

			// convert to race ratio maps
			$raceRatios = array_map(function ($race) {
				return ['race' => $race, 'ratio' => false];
			}, $races);
			// zipper in the ratios for each race
			for ($i = 0; $i < count($table_races); $i++) {
				$raceRatios[$i]['ratio'] = $table_races_percents[$mix][$i];
			}
		}

		// give each race some population
		$total = 0;
		foreach ($raceRatios as $raceRatio) {
			$this->races[$raceRatio['race']] = floor($raceRatio['ratio'] * $this->populationSize);
			$total += $this->races[$raceRatio['race']];
		}
		// give the majority race any left overs
		$this->races[$raceRatios[0]['race']] += $this->populationSize - $total;
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


	public function wealth() {
		return (doubleval($this->gold_piece_limit()) * 0.5) * (doubleval($this->populationSize) * 0.1);
	}

	public function gold_piece_limit() {
		global $table_population_wealth;
		return get_table_result_index($table_population_wealth, $this->populationType);
	}

	public function king_income() {
		global $table_king_income;
		$value = get_table_result_index($table_king_income, $this->populationType);

		return $value * $this->wealth();
	}

	public function magic_resources() {
		global $table_magic_resources;
		$value = get_table_result_index($table_magic_resources, $this->populationType);
		return $value * $this->wealth();
	}

	private function random_power_centers() {
		global $table_population_power_center;
		global $table_population_influence_points;
		global $table_population_power_center_modifier;
		global $table_power_center_type;
		global $table_power_center_unabsorbed;

		$value = get_table_result_index($table_population_power_center, $this->populationType);
		$count = rand_range($value[MinMax::MIN], $value[kMax]);

		if ($count) {
			$value = get_table_result_index($table_population_influence_points, $this->populationType);
			$influence_points = rand_range($value[MinMax::MIN], $value[kMax]);

			$percent = get_table_result_index($table_power_center_unabsorbed, $this->populationType);

			$this->influence_points_unabsorbed = $influence_points * $percent;
			$influence_points -= $this->influence_points_unabsorbed;
			$total_influence_points = $influence_points;

			$average_influence = $influence_points / $count;
			$offset_influence = $average_influence / 10.0;

//			$modifier = get_table_result_index($table_population_power_center_modifier, $this->populationType);

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
				$content = file_get_contents("http://strategerygames.com/dictionary/remote.php?dictionary=" . urlencode($dictionary) . '&shuffle=0&text=' . urlencode($this->name));
				$content = mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
				$this->name =  $content;
			}
		}

		$this->name = ucwords($this->name);
	}

	public function guilds_count() {
		return $this->guilds_count;
	}

	public function wards_count($ward_type) {
		$count = 0;
		foreach ($this->wards as $ward) {
			if ($ward->type() == $ward_type) {
				$count++;
			}
		}
		return $count;
	}
}
