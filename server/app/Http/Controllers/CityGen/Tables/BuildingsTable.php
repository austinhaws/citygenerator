<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\Building;
use App\Http\Controllers\CityGen\Constants\MinMax;
use App\Http\Controllers\CityGen\Constants\Ward;

class BuildingsTable extends BaseTable
{

    function getTable()
    {
        return array(
            Ward::PATRICIATE, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '12' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '14' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '15' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '16' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '36' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '46' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '56' => array(
                    'type' => Building::OFFICE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '61' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '66' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '70' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '74' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '76' => array(
                    'type' => Building::GARDEN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '79' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '81' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '83' => array(
                    'type' => Building::RESTAURANT,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '85' => array(
                    'type' => Building::RESTAURANT,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '87' => array(
                    'type' => Building::LIBRARY,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '89' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '91' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '92' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '93' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '94' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '95' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '96' => array(
                    'type' => Building::CEMETERY,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '97' => array(
                    'type' => Building::CISTERN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    MinMax::MIN => 3,
                    MinMax::MAX => 3,
                ),
                '99' => array(
                    'type' => Building::PLAZA,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '100' => array(
                    'type' => Building::UNIVERSITY,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
            ),
            Ward::MERCHANT, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '14' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '16' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '21' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '26' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '36' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '46' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '56' => array(
                    'type' => Building::OFFICE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '61' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '66' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '70' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '74' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '76' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '79' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '81' => array(
                    'type' => Building::REST,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '83' => array(
                    'type' => Building::GUILD_HALL,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '85' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '87' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '89' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '91' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '92' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '93' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '94' => array(
                    'type' => Building::LIBRARY,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '95' => array(
                    'type' => Building::GARDEN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '96' => array(
                    'type' => Building::CEMETERY,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '97' => array(
                    'type' => Building::CISTERN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '99' => array(
                    'type' => Building::PLAZA,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '100' => array(
                    'type' => Building::UNIVERSITY,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
            ),
            Ward::MILITARY, array(
                '10' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '12' => array(
                    'type' => Building::BARRACK,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '14' => array(
                    'type' => Building::BARRACK,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '15' => array(
                    'type' => Building::BARRACK,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '16' => array(
                    'type' => Building::BARRACK,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '21' => array(
                    'type' => Building::BARRACK,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '26' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 4,
                ),
                '46' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '56' => array(
                    'type' => Building::STABLE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '61' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 4,
                ),
                '66' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 4,
                ),
                '70' => array(
                    'type' => Building::BARRACK,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '76' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 4,
                ),
                '78' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 4,
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '83' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '85' => array(
                    'type' => Building::PRISON,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '87' => array(
                    'type' => Building::CORRAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '89' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '91' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '92' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '93' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '94' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '95' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '96' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 4,
                ),
                '97' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 4,
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '99' => array(
                    'type' => Building::INFIRMARY,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '100' => array(
                    'type' => Building::COLISEUM,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
            ),
            Ward::ADMINISTRATION, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '14' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '15' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '16' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '21' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '26' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '36' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '46' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '56' => array(
                    'type' => Building::OFFICE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '61' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '66' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '70' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '74' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '76' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '79' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '81' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '83' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '85' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '87' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '89' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '91' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '92' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '93' => array(
                    'type' => Building::LIBRARY,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '94' => array(
                    'type' => Building::CEMETERY,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '95' => array(
                    'type' => Building::ASYLUM,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '96' => array(
                    'type' => Building::CISTERN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '97' => array(
                    'type' => Building::GUILD_HALL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '99' => array(
                    'type' => Building::PRISON,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '100' => array(
                    'type' => Building::PLAZA,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
            ),
            Ward::ODORIFEROUS, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '26' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '46' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '51' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '56' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '61' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '70' => array(
                    'type' => Building::TENEMENT,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '74' => array(
                    'type' => Building::TENEMENT,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '76' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '79' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '83' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '85' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '89' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '91' => array(
                    'type' => Building::CORRAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '92' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '93' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '94' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '95' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '96' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '97' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '98' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '99' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '100' => array(
                    'type' => Building::CEMETERY,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
            ),
            Ward::CRAFTSMEN, array(
                '10' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '16' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '21' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '26' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '36' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '46' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '51' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '56' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '61' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '66' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '74' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '76' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '79' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '81' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '83' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '85' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '89' => array(
                    'type' => Building::TENEMENT,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '91' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '92' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '93' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '94' => array(
                    'type' => Building::GUILD_HALL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '95' => array(
                    'type' => Building::GUILD_HALL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '96' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '97' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '98' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '99' => array(
                    'type' => Building::CISTERN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '100' => array(
                    'type' => Building::THEATER,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
            ),
            Ward::RIVER, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '46' => array(
                    'type' => Building::TENEMENT,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '51' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '56' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '61' => array(
                    'type' => Building::TENEMENT,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '76' => array(
                    'type' => Building::MILL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '79' => array(
                    'type' => Building::MILL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '83' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '85' => array(
                    'type' => Building::OFFICE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '89' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '91' => array(
                    'type' => Building::CORRAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '92' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '93' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '94' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '95' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '96' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '97' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '99' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '100' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
            ),
            Ward::SEA, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '46' => array(
                    'type' => Building::TENEMENT,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '51' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '56' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '61' => array(
                    'type' => Building::TENEMENT,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '76' => array(
                    'type' => Building::MILL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '79' => array(
                    'type' => Building::MILL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '83' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '85' => array(
                    'type' => Building::OFFICE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '89' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '91' => array(
                    'type' => Building::CORRAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '92' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '93' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '94' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '95' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '96' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '97' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '99' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '100' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
            ),
            Ward::MARKET, array(
                '10' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '12' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '14' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '15' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '16' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '21' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '26' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '36' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '46' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '56' => array(
                    'type' => Building::OFFICE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '61' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '70' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '74' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '76' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '79' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '81' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '83' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '85' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '87' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '89' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '91' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '92' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '93' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '94' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '95' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '96' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '97' => array(
                    'type' => Building::CISTERN,
                    MinMax::MIN => 1,
                    MinMax::MAX => 2,
                ),
                '98' => array(
                    'type' => Building::GRAINERY,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '99' => array(
                    'type' => Building::GUILD_HALL,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
                '100' => array(
                    'type' => Building::PLAZA,
                    MinMax::MIN => 1,
                    MinMax::MAX => 3,
                ),
            ),
            Ward::GATE, array(
                '10' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '12' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '14' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '15' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '21' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '26' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '46' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '51' => array(
                    'type' => Building::STABLE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '56' => array(
                    'type' => Building::STABLE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '61' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '66' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '76' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '79' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '81' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '83' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '85' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '87' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '89' => array(
                    'type' => Building::OFFICE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 3,
                ),
                '91' => array(
                    'type' => Building::CORRAL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '92' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '93' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '94' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '95' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '96' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '97' => array(
                    'type' => Building::BATH_HOUSE,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '98' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '99' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '100' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
            ),
            Ward::SLUM, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '46' => array(
                    'type' => Building::TENEMENT,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '51' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '56' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '61' => array(
                    'type' => Building::WAREHOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '66' => array(
                    'type' => Building::SHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '70' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '74' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '76' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '79' => array(
                    'type' => Building::INN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '81' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '83' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '85' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '87' => array(
                    'type' => Building::HOSPITAL,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '89' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '91' => array(
                    'type' => Building::RELIGIOUS,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
                '92' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '93' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '94' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '95' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '96' => array(
                    'type' => Building::BATH,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '97' => array(
                    'type' => Building::ADMIN,
                    MinMax::MIN => 2,
                    MinMax::MAX => 2,
                ),
                '98' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '99' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '100' => array(
                    'type' => Building::CEMETERY,
                    MinMax::MIN => 3,
                    MinMax::MAX => 4,
                ),
            ),
            Ward::SHANTY, array(
                '10' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '12' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '14' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '15' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '16' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '21' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '26' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '36' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '46' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '51' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '56' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '61' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '66' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '70' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '74' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '76' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '79' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '81' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '83' => array(
                    'type' => Building::HOUSE,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '85' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '87' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '89' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '91' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '92' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '93' => array(
                    'type' => Building::TAVERN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '94' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '95' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '96' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '97' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '98' => array(
                    'type' => Building::WORKSHOP,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '99' => array(
                    'type' => Building::WELL,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
                '100' => array(
                    'type' => Building::FOUNTAIN,
                    MinMax::MIN => 4,
                    MinMax::MAX => 4,
                ),
            ),
        );
    }
}
