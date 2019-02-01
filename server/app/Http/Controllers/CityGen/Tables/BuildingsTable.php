<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\Building;
use App\Http\Controllers\CityGen\Constants\Ward;
use App\Http\Controllers\CityGen\Models\MinMax;

class BuildingsTable extends BaseTable
{

    function getTable()
    {
        return array(
            Ward::PATRICIATE, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    new MinMax(1, 2),
                ),
                '12' => array(
                    'type' => Building::HOUSE,
                    new MinMax(1, 2),
                ),
                '14' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(1, 2),
                ),
                '15' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(1, 2),
                ),
                '16' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(1, 2),
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    new MinMax(1, 2),
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    new MinMax(1, 2),
                ),
                '36' => array(
                    'type' => Building::TAVERN,
                    new MinMax(1, 2),
                ),
                '46' => array(
                    'type' => Building::SHOP,
                    new MinMax(1, 2),
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    new MinMax(1, 2),
                ),
                '56' => array(
                    'type' => Building::OFFICE,
                    new MinMax(1, 2),
                ),
                '61' => array(
                    'type' => Building::INN,
                    new MinMax(1, 2),
                ),
                '66' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(1, 2),
                ),
                '70' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(1, 2),
                ),
                '74' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(1, 2),
                ),
                '76' => array(
                    'type' => Building::GARDEN,
                    new MinMax(1, 2),
                ),
                '79' => array(
                    'type' => Building::BATH,
                    new MinMax(1, 2),
                ),
                '81' => array(
                    'type' => Building::BATH,
                    new MinMax(1, 2),
                ),
                '83' => array(
                    'type' => Building::RESTAURANT,
                    new MinMax(1, 2),
                ),
                '85' => array(
                    'type' => Building::RESTAURANT,
                    new MinMax(1, 2),
                ),
                '87' => array(
                    'type' => Building::LIBRARY,
                    new MinMax(1, 2),
                ),
                '89' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(1, 2),
                ),
                '91' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 3),
                ),
                '92' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(1, 2),
                ),
                '93' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(1, 2),
                ),
                '94' => array(
                    'type' => Building::WELL,
                    new MinMax(1, 2),
                ),
                '95' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(1, 2),
                ),
                '96' => array(
                    'type' => Building::CEMETERY,
                    new MinMax(1, 2),
                ),
                '97' => array(
                    'type' => Building::CISTERN,
                    new MinMax(2, 2),
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    new MinMax(3, 3),
                ),
                '99' => array(
                    'type' => Building::PLAZA,
                    new MinMax(1, 2),
                ),
                '100' => array(
                    'type' => Building::UNIVERSITY,
                    new MinMax(1, 2),
                ),
            ),
            Ward::MERCHANT, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    new MinMax(1, 3),
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 3),
                ),
                '14' => array(
                    'type' => Building::HOUSE,
                    new MinMax(1, 3),
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 3),
                ),
                '16' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 3),
                ),
                '21' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 3),
                ),
                '26' => array(
                    'type' => Building::SHOP,
                    new MinMax(1, 3),
                ),
                '36' => array(
                    'type' => Building::SHOP,
                    new MinMax(1, 3),
                ),
                '46' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    new MinMax(1, 3),
                ),
                '56' => array(
                    'type' => Building::OFFICE,
                    new MinMax(1, 3),
                ),
                '61' => array(
                    'type' => Building::TAVERN,
                    new MinMax(1, 3),
                ),
                '66' => array(
                    'type' => Building::TAVERN,
                    new MinMax(1, 3),
                ),
                '70' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(1, 3),
                ),
                '74' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(1, 3),
                ),
                '76' => array(
                    'type' => Building::INN,
                    new MinMax(1, 3),
                ),
                '79' => array(
                    'type' => Building::INN,
                    new MinMax(1, 3),
                ),
                '81' => array(
                    'type' => Building::REST,
                    new MinMax(1, 3),
                ),
                '83' => array(
                    'type' => Building::GUILD_HALL,
                    new MinMax(1, 3),
                ),
                '85' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(1, 3),
                ),
                '87' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '89' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(1, 3),
                ),
                '91' => array(
                    'type' => Building::BATH,
                    new MinMax(1, 3),
                ),
                '92' => array(
                    'type' => Building::BATH,
                    new MinMax(1, 3),
                ),
                '93' => array(
                    'type' => Building::WELL,
                    new MinMax(1, 3),
                ),
                '94' => array(
                    'type' => Building::LIBRARY,
                    new MinMax(1, 2),
                ),
                '95' => array(
                    'type' => Building::GARDEN,
                    new MinMax(2, 3),
                ),
                '96' => array(
                    'type' => Building::CEMETERY,
                    new MinMax(1, 3),
                ),
                '97' => array(
                    'type' => Building::CISTERN,
                    new MinMax(3, 4),
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    new MinMax(2, 2),
                ),
                '99' => array(
                    'type' => Building::PLAZA,
                    new MinMax(1, 3),
                ),
                '100' => array(
                    'type' => Building::UNIVERSITY,
                    new MinMax(1, 2),
                ),
            ),
            Ward::MILITARY, array(
                '10' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(3, 4),
                ),
                '12' => array(
                    'type' => Building::BARRACK,
                    new MinMax(4, 4),
                ),
                '14' => array(
                    'type' => Building::BARRACK,
                    new MinMax(4, 4),
                ),
                '15' => array(
                    'type' => Building::BARRACK,
                    new MinMax(4, 4),
                ),
                '16' => array(
                    'type' => Building::BARRACK,
                    new MinMax(4, 4),
                ),
                '21' => array(
                    'type' => Building::BARRACK,
                    new MinMax(4, 4),
                ),
                '26' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(3, 4),
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    new MinMax(2, 4),
                ),
                '46' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    new MinMax(2, 3),
                ),
                '56' => array(
                    'type' => Building::STABLE,
                    new MinMax(2, 3),
                ),
                '61' => array(
                    'type' => Building::TAVERN,
                    new MinMax(2, 4),
                ),
                '66' => array(
                    'type' => Building::TAVERN,
                    new MinMax(2, 4),
                ),
                '70' => array(
                    'type' => Building::BARRACK,
                    new MinMax(4, 4),
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '76' => array(
                    'type' => Building::SHOP,
                    new MinMax(2, 4),
                ),
                '78' => array(
                    'type' => Building::SHOP,
                    new MinMax(2, 4),
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '83' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '85' => array(
                    'type' => Building::PRISON,
                    new MinMax(4, 4),
                ),
                '87' => array(
                    'type' => Building::CORRAL,
                    new MinMax(2, 2),
                ),
                '89' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 3),
                ),
                '91' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '92' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '93' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '94' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '95' => array(
                    'type' => Building::BATH,
                    new MinMax(2, 3),
                ),
                '96' => array(
                    'type' => Building::WELL,
                    new MinMax(2, 4),
                ),
                '97' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(2, 4),
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    new MinMax(2, 2),
                ),
                '99' => array(
                    'type' => Building::INFIRMARY,
                    new MinMax(2, 2),
                ),
                '100' => array(
                    'type' => Building::COLISEUM,
                    new MinMax(2, 3),
                ),
            ),
            Ward::ADMINISTRATION, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    new MinMax(2, 3),
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '14' => array(
                    'type' => Building::HOUSE,
                    new MinMax(2, 3),
                ),
                '15' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '16' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '21' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '26' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '36' => array(
                    'type' => Building::TAVERN,
                    new MinMax(2, 3),
                ),
                '46' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    new MinMax(1, 3),
                ),
                '56' => array(
                    'type' => Building::OFFICE,
                    new MinMax(2, 3),
                ),
                '61' => array(
                    'type' => Building::SHOP,
                    new MinMax(2, 3),
                ),
                '66' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '70' => array(
                    'type' => Building::HOUSE,
                    new MinMax(2, 3),
                ),
                '74' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(2, 3),
                ),
                '76' => array(
                    'type' => Building::INN,
                    new MinMax(2, 3),
                ),
                '79' => array(
                    'type' => Building::INN,
                    new MinMax(2, 3),
                ),
                '81' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(1, 3),
                ),
                '83' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(1, 3),
                ),
                '85' => array(
                    'type' => Building::BATH,
                    new MinMax(2, 3),
                ),
                '87' => array(
                    'type' => Building::BATH,
                    new MinMax(2, 3),
                ),
                '89' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(2, 3),
                ),
                '91' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(2, 3),
                ),
                '92' => array(
                    'type' => Building::WELL,
                    new MinMax(2, 3),
                ),
                '93' => array(
                    'type' => Building::LIBRARY,
                    new MinMax(1, 2),
                ),
                '94' => array(
                    'type' => Building::CEMETERY,
                    new MinMax(2, 3),
                ),
                '95' => array(
                    'type' => Building::ASYLUM,
                    new MinMax(2, 3),
                ),
                '96' => array(
                    'type' => Building::CISTERN,
                    new MinMax(3, 4),
                ),
                '97' => array(
                    'type' => Building::GUILD_HALL,
                    new MinMax(3, 4),
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    new MinMax(2, 2),
                ),
                '99' => array(
                    'type' => Building::PRISON,
                    new MinMax(2, 2),
                ),
                '100' => array(
                    'type' => Building::PLAZA,
                    new MinMax(1, 3),
                ),
            ),
            Ward::ODORIFEROUS, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '26' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '46' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '51' => array(
                    'type' => Building::TAVERN,
                    new MinMax(3, 4),
                ),
                '56' => array(
                    'type' => Building::TAVERN,
                    new MinMax(3, 4),
                ),
                '61' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(3, 4),
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    new MinMax(3, 4),
                ),
                '70' => array(
                    'type' => Building::TENEMENT,
                    new MinMax(3, 4),
                ),
                '74' => array(
                    'type' => Building::TENEMENT,
                    new MinMax(3, 4),
                ),
                '76' => array(
                    'type' => Building::INN,
                    new MinMax(3, 4),
                ),
                '79' => array(
                    'type' => Building::INN,
                    new MinMax(3, 4),
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '83' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(3, 4),
                ),
                '85' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(3, 4),
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 3),
                ),
                '89' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 3),
                ),
                '91' => array(
                    'type' => Building::CORRAL,
                    new MinMax(2, 2),
                ),
                '92' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '93' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '94' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '95' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '96' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '97' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '98' => array(
                    'type' => Building::WELL,
                    new MinMax(3, 4),
                ),
                '99' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(3, 4),
                ),
                '100' => array(
                    'type' => Building::CEMETERY,
                    new MinMax(3, 4),
                ),
            ),
            Ward::CRAFTSMEN, array(
                '10' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '16' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '21' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '26' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '36' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '46' => array(
                    'type' => Building::HOUSE,
                    new MinMax(2, 3),
                ),
                '51' => array(
                    'type' => Building::SHOP,
                    new MinMax(2, 3),
                ),
                '56' => array(
                    'type' => Building::SHOP,
                    new MinMax(2, 3),
                ),
                '61' => array(
                    'type' => Building::TAVERN,
                    new MinMax(2, 3),
                ),
                '66' => array(
                    'type' => Building::TAVERN,
                    new MinMax(2, 3),
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 2),
                ),
                '74' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(2, 3),
                ),
                '76' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 2),
                ),
                '79' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 2),
                ),
                '81' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(2, 3),
                ),
                '83' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(2, 3),
                ),
                '85' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 3),
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 3),
                ),
                '89' => array(
                    'type' => Building::TENEMENT,
                    new MinMax(2, 2),
                ),
                '91' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '92' => array(
                    'type' => Building::BATH,
                    new MinMax(2, 3),
                ),
                '93' => array(
                    'type' => Building::BATH,
                    new MinMax(2, 3),
                ),
                '94' => array(
                    'type' => Building::GUILD_HALL,
                    new MinMax(3, 4),
                ),
                '95' => array(
                    'type' => Building::GUILD_HALL,
                    new MinMax(3, 4),
                ),
                '96' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(2, 3),
                ),
                '97' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(2, 3),
                ),
                '98' => array(
                    'type' => Building::WELL,
                    new MinMax(2, 3),
                ),
                '99' => array(
                    'type' => Building::CISTERN,
                    new MinMax(3, 4),
                ),
                '100' => array(
                    'type' => Building::THEATER,
                    new MinMax(2, 2),
                ),
            ),
            Ward::RIVER, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '46' => array(
                    'type' => Building::TENEMENT,
                    new MinMax(4, 4),
                ),
                '51' => array(
                    'type' => Building::INN,
                    new MinMax(3, 4),
                ),
                '56' => array(
                    'type' => Building::INN,
                    new MinMax(3, 4),
                ),
                '61' => array(
                    'type' => Building::TENEMENT,
                    new MinMax(3, 4),
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    new MinMax(3, 4),
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '76' => array(
                    'type' => Building::MILL,
                    new MinMax(3, 4),
                ),
                '79' => array(
                    'type' => Building::MILL,
                    new MinMax(3, 4),
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '83' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '85' => array(
                    'type' => Building::OFFICE,
                    new MinMax(3, 4),
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 3),
                ),
                '89' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(3, 4),
                ),
                '91' => array(
                    'type' => Building::CORRAL,
                    new MinMax(2, 2),
                ),
                '92' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '93' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '94' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '95' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '96' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '97' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    new MinMax(2, 2),
                ),
                '99' => array(
                    'type' => Building::WELL,
                    new MinMax(3, 4),
                ),
                '100' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(3, 4),
                ),
            ),
            Ward::SEA, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    new MinMax(3, 4),
                ),
                '46' => array(
                    'type' => Building::TENEMENT,
                    new MinMax(4, 4),
                ),
                '51' => array(
                    'type' => Building::INN,
                    new MinMax(3, 4),
                ),
                '56' => array(
                    'type' => Building::INN,
                    new MinMax(3, 4),
                ),
                '61' => array(
                    'type' => Building::TENEMENT,
                    new MinMax(3, 4),
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    new MinMax(3, 4),
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '76' => array(
                    'type' => Building::MILL,
                    new MinMax(3, 4),
                ),
                '79' => array(
                    'type' => Building::MILL,
                    new MinMax(3, 4),
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '83' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(3, 4),
                ),
                '85' => array(
                    'type' => Building::OFFICE,
                    new MinMax(3, 4),
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 3),
                ),
                '89' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(3, 4),
                ),
                '91' => array(
                    'type' => Building::CORRAL,
                    new MinMax(2, 2),
                ),
                '92' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '93' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '94' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '95' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '96' => array(
                    'type' => Building::BATH,
                    new MinMax(3, 4),
                ),
                '97' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    new MinMax(2, 2),
                ),
                '99' => array(
                    'type' => Building::WELL,
                    new MinMax(3, 4),
                ),
                '100' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(3, 4),
                ),
            ),
            Ward::MARKET, array(
                '10' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '12' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '14' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '15' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '16' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '21' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 3),
                ),
                '26' => array(
                    'type' => Building::TAVERN,
                    new MinMax(1, 3),
                ),
                '36' => array(
                    'type' => Building::TAVERN,
                    new MinMax(1, 3),
                ),
                '46' => array(
                    'type' => Building::SHOP,
                    new MinMax(1, 3),
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    new MinMax(1, 2),
                ),
                '56' => array(
                    'type' => Building::OFFICE,
                    new MinMax(1, 2),
                ),
                '61' => array(
                    'type' => Building::ADMIN,
                    new MinMax(1, 3),
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    new MinMax(1, 3),
                ),
                '70' => array(
                    'type' => Building::HOUSE,
                    new MinMax(1, 2),
                ),
                '74' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(1, 2),
                ),
                '76' => array(
                    'type' => Building::INN,
                    new MinMax(1, 3),
                ),
                '79' => array(
                    'type' => Building::INN,
                    new MinMax(1, 3),
                ),
                '81' => array(
                    'type' => Building::SHOP,
                    new MinMax(1, 3),
                ),
                '83' => array(
                    'type' => Building::SHOP,
                    new MinMax(1, 3),
                ),
                '85' => array(
                    'type' => Building::SHOP,
                    new MinMax(1, 3),
                ),
                '87' => array(
                    'type' => Building::HOUSE,
                    new MinMax(1, 2),
                ),
                '89' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(1, 2),
                ),
                '91' => array(
                    'type' => Building::BATH,
                    new MinMax(1, 2),
                ),
                '92' => array(
                    'type' => Building::BATH,
                    new MinMax(1, 2),
                ),
                '93' => array(
                    'type' => Building::BATH,
                    new MinMax(1, 2),
                ),
                '94' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(1, 3),
                ),
                '95' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(1, 3),
                ),
                '96' => array(
                    'type' => Building::WELL,
                    new MinMax(1, 3),
                ),
                '97' => array(
                    'type' => Building::CISTERN,
                    new MinMax(1, 2),
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    new MinMax(2, 2),
                ),
                '99' => array(
                    'type' => Building::GUILD_HALL,
                    new MinMax(1, 3),
                ),
                '100' => array(
                    'type' => Building::PLAZA,
                    new MinMax(1, 3),
                ),
            ),
            Ward::GATE, array(
                '10' => array(
                    'type' => Building::TAVERN,
                    new MinMax(2, 3),
                ),
                '12' => array(
                    'type' => Building::INN,
                    new MinMax(2, 3),
                ),
                '14' => array(
                    'type' => Building::INN,
                    new MinMax(2, 3),
                ),
                '15' => array(
                    'type' => Building::INN,
                    new MinMax(2, 3),
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    new MinMax(2, 2),
                ),
                '21' => array(
                    'type' => Building::TAVERN,
                    new MinMax(2, 3),
                ),
                '26' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 3),
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    new MinMax(2, 2),
                ),
                '46' => array(
                    'type' => Building::INN,
                    new MinMax(2, 3),
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    new MinMax(2, 3),
                ),
                '56' => array(
                    'type' => Building::STABLE,
                    new MinMax(2, 3),
                ),
                '61' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 2),
                ),
                '66' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(2, 2),
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 3),
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(2, 3),
                ),
                '76' => array(
                    'type' => Building::SHOP,
                    new MinMax(2, 3),
                ),
                '79' => array(
                    'type' => Building::SHOP,
                    new MinMax(2, 3),
                ),
                '81' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(2, 2),
                ),
                '83' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(2, 2),
                ),
                '85' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 2),
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(2, 2),
                ),
                '89' => array(
                    'type' => Building::OFFICE,
                    new MinMax(2, 3),
                ),
                '91' => array(
                    'type' => Building::CORRAL,
                    new MinMax(2, 2),
                ),
                '92' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '93' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '94' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '95' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(2, 2),
                ),
                '96' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(2, 2),
                ),
                '97' => array(
                    'type' => Building::BATH_HOUSE,
                    new MinMax(2, 2),
                ),
                '98' => array(
                    'type' => Building::BATH,
                    new MinMax(2, 2),
                ),
                '99' => array(
                    'type' => Building::WELL,
                    new MinMax(2, 2),
                ),
                '100' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(2, 2),
                ),
            ),
            Ward::SLUM, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '46' => array(
                    'type' => Building::TENEMENT,
                    new MinMax(4, 4),
                ),
                '51' => array(
                    'type' => Building::TAVERN,
                    new MinMax(4, 4),
                ),
                '56' => array(
                    'type' => Building::TAVERN,
                    new MinMax(4, 4),
                ),
                '61' => array(
                    'type' => Building::WAREHOUSE,
                    new MinMax(4, 4),
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    new MinMax(4, 4),
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '76' => array(
                    'type' => Building::INN,
                    new MinMax(4, 4),
                ),
                '79' => array(
                    'type' => Building::INN,
                    new MinMax(4, 4),
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '83' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '85' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(4, 4),
                ),
                '87' => array(
                    'type' => Building::HOSPITAL,
                    new MinMax(4, 4),
                ),
                '89' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(3, 4),
                ),
                '91' => array(
                    'type' => Building::RELIGIOUS,
                    new MinMax(3, 4),
                ),
                '92' => array(
                    'type' => Building::BATH,
                    new MinMax(4, 4),
                ),
                '93' => array(
                    'type' => Building::BATH,
                    new MinMax(4, 4),
                ),
                '94' => array(
                    'type' => Building::BATH,
                    new MinMax(4, 4),
                ),
                '95' => array(
                    'type' => Building::BATH,
                    new MinMax(4, 4),
                ),
                '96' => array(
                    'type' => Building::BATH,
                    new MinMax(4, 4),
                ),
                '97' => array(
                    'type' => Building::ADMIN,
                    new MinMax(2, 2),
                ),
                '98' => array(
                    'type' => Building::WELL,
                    new MinMax(4, 4),
                ),
                '99' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(4, 4),
                ),
                '100' => array(
                    'type' => Building::CEMETERY,
                    new MinMax(3, 4),
                ),
            ),
            Ward::SHANTY, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '46' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '51' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '56' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '61' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '66' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '70' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '74' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '76' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '79' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '81' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '83' => array(
                    'type' => Building::HOUSE,
                    new MinMax(4, 4),
                ),
                '85' => array(
                    'type' => Building::TAVERN,
                    new MinMax(4, 4),
                ),
                '87' => array(
                    'type' => Building::TAVERN,
                    new MinMax(4, 4),
                ),
                '89' => array(
                    'type' => Building::TAVERN,
                    new MinMax(4, 4),
                ),
                '91' => array(
                    'type' => Building::TAVERN,
                    new MinMax(4, 4),
                ),
                '92' => array(
                    'type' => Building::TAVERN,
                    new MinMax(4, 4),
                ),
                '93' => array(
                    'type' => Building::TAVERN,
                    new MinMax(4, 4),
                ),
                '94' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '95' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '96' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '97' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '98' => array(
                    'type' => Building::WORKSHOP,
                    new MinMax(4, 4),
                ),
                '99' => array(
                    'type' => Building::WELL,
                    new MinMax(4, 4),
                ),
                '100' => array(
                    'type' => Building::FOUNTAIN,
                    new MinMax(4, 4),
                ),
            ),
        );
    }
}
