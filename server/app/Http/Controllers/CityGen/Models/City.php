<?php

namespace App\Http\Controllers\CityGen\Models;

use App\Http\Controllers\CityGen\Constants\BooleanRandom;

class City
{
    /** @var int */
    public $populationSize = null;
    /** @var string PopulationType:: */
    public $populationType = null;
    /** @var string */
    public $name = '';
    /** @var int int */
    public $numStructures = 0;
    /** @var float  */
    public $acres = 0.0;
    /** @var bool BooleanRandom:: */
    public $hasSea = BooleanRandom::FALSE;
    /** @var bool BooleanRandom:: */
    public $hasMilitary = BooleanRandom::FALSE;
    /** @var bool BooleanRandom:: */
    public $hasRiver = BooleanRandom::FALSE;
    // todo rename to numGates
    /** @var int */
    public $gates = 0;
    /** @var CityWard[] */
    public $wards = [];
    /** @var CityProfession[] */
    public $professions = [];
    /** @var int */
    public $influencePointsUnabsorbed = 0;

    /** @var float */
    public $wealth;
    /** @var int */
    public $goldPieceLimit;
    /** @var float */
    public $magicResources;
    /** @var float */
    public $kingIncome;

    /** @var array CityPowerCenter[] */
    public $powerCenters = [];

    /** @var string Race:: */
    public $majorityRace;
    /** @var CityRace[] */
    public $races;

    public $population_density = 0.0;
    public $guilds = array();
    public $commodities = array('export' => array(), 'import' => array());
    public $famous = array('famous' => array(), 'infamous' => array());
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

    private function random_famous_fill($num, $type)
    {
        global $table_famous;
        while ($num > 0) {
            $result = get_table_result_range($table_famous, rand_range(1, 4250));

            if (false === array_search($result, $this->famous[$type])) {
                $this->famous[$type][] = $result;
                --$num;
            }
        }
    }

    private function random_famous()
    {
        global $table_famous_occurrence;
        $min_max = $table_famous_occurrence[$this->populationType];

        $num = rand_range($min_max[MinMax::MIN], $min_max[kMax]);
        $this->random_famous_fill($num, 'famous');
        sort($this->famous['famous']);

        $num = rand_range($min_max[MinMax::MIN], $min_max[kMax]);
        $this->random_famous_fill($num, 'infamous');
        sort($this->famous['infamous']);
    }

    private function random_commodities_fill($num, $type)
    {
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

    private function random_commodities()
    {
        global $table_commodity_count;
        $min_max = $table_commodity_count[$this->populationType];

        $num = rand_range($min_max[MinMax::MIN], $min_max[kMax]);
        $this->random_commodities_fill($num, 'export');
        sort($this->commodities['export']);

        $num = rand_range($min_max[MinMax::MIN], $min_max[kMax]);
        $this->random_commodities_fill($num, 'import');
        sort($this->commodities['import']);
    }


    private function random_populationSize()
    {
        global $table_population_size;
        // check if it was hand entered so already set
        if ($this->populationSize === false) {
            $value = get_table_result_index($table_population_size, $this->populationType);
            $this->populationSize = rand_range($value[MinMax::MIN], $value[kMax]);
        }
    }


    private function random_buildings($ward, $building_weights)
    {
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

    private function random_guilds()
    {
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


    public function output_races()
    {
        $parts = array();
        foreach ($this->races as $race => $amount) {
            if ($amount) {
                $parts[] = $race . ' (' . output_integer($amount) . ')';
            }
        }
        return implode($parts, '; ');
    }


    public function random_name()
    {
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
                $this->name = $content;
            }
        }

        $this->name = ucwords($this->name);
    }

    public function guilds_count()
    {
        return $this->guilds_count;
    }

    public function wards_count($ward_type)
    {
        $count = 0;
        foreach ($this->wards as $ward) {
            if ($ward->type() == $ward_type) {
                $count++;
            }
        }
        return $count;
    }
}
