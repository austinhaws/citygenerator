<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\NPCClass;

class NPCClassInfluenceTable extends BaseTable
{
    function getTable()
    {
        return array(
            NPCClass::ADEPT,
            NPCClass::ARISTOCRAT,
            NPCClass::BARBARIAN,
            NPCClass::BARD,
            NPCClass::CLERIC,
            NPCClass::COMMONER,
            NPCClass::DRUID,
            NPCClass::EXPERT,
            NPCClass::FIGHTER,
            NPCClass::MONK,
            NPCClass::PALADIN,
            NPCClass::RANGER,
            NPCClass::ROGUE,
            NPCClass::SORCERER,
            NPCClass::WARRIOR,
            NPCClass::WIZARD,
            NPCClass::MONSTER,
        );
    }
}
