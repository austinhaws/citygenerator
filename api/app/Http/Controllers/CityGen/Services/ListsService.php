<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Constants\PopulationType;

class ListsService {

	public function getLists() {
	    return [
	        'populationTypes' => [
                [ 'id' => PopulationType::THORP, 'label' => PopulationType::THORP],
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
