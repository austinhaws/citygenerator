<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Constants\PopulationType;

class ListsService {

	public function getLists() {
	    return [
	        'populationTypes' => [
                [ 'id' => PopulationType::THORP, 'label' => 'Thorp (20-80)' ],
                [ 'id' => PopulationType::HAMLET, 'label' => 'Hamlet (81-400)' ],
                [ 'id' => PopulationType::VILLAGE, 'label' => 'Village (401-900)' ],
                [ 'id' => PopulationType::SMALL_TOWN, 'label' => 'Small Town (901-2000)' ],
                [ 'id' => PopulationType::LARGE_TOWN, 'label' => 'Large Town (2001-5000)' ],
                [ 'id' => PopulationType::SMALL_CITY, 'label' => 'Small City (5001-12000)' ],
                [ 'id' => PopulationType::LARGE_CITY, 'label' => 'Large City (12001-32000)' ],
                [ 'id' => PopulationType::METROPOLIS, 'label' => 'Metropolis (32001+)' ],

				
				//                define('kPopulationType_Hamlet', 'Hamlet');
//                define('kPopulationType_Village', 'Village');
//                define('kPopulationType_SmallTown', 'SmallTown');
//                define('kPopulationType_LargeTown', 'LargeTown');
//                define('kPopulationType_SmallCity', 'SmallCity');
//                define('kPopulationType_LargeCity', 'LargeCity');
//                define('kPopulationType_Metropolis', 'Metropolis');

            ],
        ];
	}
}
