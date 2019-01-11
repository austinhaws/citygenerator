<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Constants\Integration;
use App\Http\Controllers\CityGen\Constants\PopulationType;
use App\Http\Controllers\CityGen\Constants\Race;

class ListsService {

    const ID = 'id';
    const LABEL = 'label';

	public function getLists() {
	    return [
	        'populationTypes' => [
                [ ListsService::ID => PopulationType::THORP, ListsService::LABEL => 'Thorp (20-80)' ],
                [ ListsService::ID => PopulationType::HAMLET, ListsService::LABEL => 'Hamlet (81-400)' ],
                [ ListsService::ID => PopulationType::VILLAGE, ListsService::LABEL => 'Village (401-900)' ],
                [ ListsService::ID => PopulationType::SMALL_TOWN, ListsService::LABEL => 'Small Town (901-2000)' ],
                [ ListsService::ID => PopulationType::LARGE_TOWN, ListsService::LABEL => 'Large Town (2001-5000)' ],
                [ ListsService::ID => PopulationType::SMALL_CITY, ListsService::LABEL => 'Small City (5001-12000)' ],
                [ ListsService::ID => PopulationType::LARGE_CITY, ListsService::LABEL => 'Large City (12001-32000)' ],
                [ ListsService::ID => PopulationType::METROPOLIS, ListsService::LABEL => 'Metropolis (32001+)' ],
            ],

            'integration' => [
                [ ListsService::ID => Integration::ISOLATED, ListsService::LABEL => Integration::ISOLATED ],
                [ ListsService::ID => Integration::MIXED, ListsService::LABEL => Integration::MIXED ],
                [ ListsService::ID => Integration::INTEGRATED, ListsService::LABEL => Integration::INTEGRATED ],
                [ ListsService::ID => Integration::CUSTOM, ListsService::LABEL => Integration::CUSTOM ],
            ],
            
            'race' => [
                [ ListsService::ID => Race::HUMAN, ListsService::LABEL => Race::HUMAN ],
                [ ListsService::ID => Race::HALFLING, ListsService::LABEL => Race::HALFLING ],
                [ ListsService::ID => Race::ELF, ListsService::LABEL => Race::ELF ],
                [ ListsService::ID => Race::DWARF, ListsService::LABEL => Race::DWARF ],
                [ ListsService::ID => Race::GNOME, ListsService::LABEL => Race::GNOME ],
                [ ListsService::ID => Race::HALFELF, ListsService::LABEL => Race::HALFELF ],
                [ ListsService::ID => Race::HALFORC, ListsService::LABEL => Race::HALFORC ],
                [ ListsService::ID => Race::OTHER, ListsService::LABEL => Race::OTHER ],
            ],
        ];
	}
}
