<?php

namespace App\Http\Controllers\CityGen\Constants;

use App\Http\Controllers\CityGen\Tables\BaseTable;

class Table extends BaseEnum
{
    const BUILDINGS = 'buildings';
    const BUILDINGS_SUBTYPES = 'buildingsSubtypes';
    const CLASS_RANDOM_CLASS = 'classRandomClass';
    const COMMODITIES = 'commodities';
    const COMMODITY_COUNT = 'commodityCount';
    const FAMOUS = 'famous';
    const FAMOUS_OCCURRENCE = 'famousOccurrence';
    const GUILD_MODIFIERS = 'guildModifiers';
    const GUILDS = 'guilds';
    const INTEGRATION = 'integration';
    const IS_SIZE_AT_LEAST = 'isSizeAtLeast';
    const KING_INCOME = 'kingIncome';
    const MAGIC_RESOURCES = 'magicResources';
    const NAME_NUM_SYLLABLES = 'nameNumSyllables';
    const NAME_NUM_WORDS = 'nameNumWords';
    const NAME_PREFIXES = 'namePrefixes';
    const NAME_SUFFIXES = 'nameSuffixes';
    const NAME_WORDS = 'nameWords';
    const NAME_WORDS_COUNT = 'nameWordsCount';
    const NPC_CLASSES_MAX_LEVEL = 'npcClassesMaxLevel';
    const NPC_LEVEL_MODIFIERS = 'npcLevelModifiers';
    const POPULATION_ACRES = 'populationAcres';
    const POPULATION_HAS_WALLS = 'populationHasWalls';
    const POPULATION_INFLUENCE_POINTS = 'populationInfluencePoints';
    const POPULATION_MILITARY = 'populationMilitary';
    const POPULATION_NUM_STRUCTURES = 'populationNumStructures';
    const POPULATION_NUM_WALLS = 'populationNumWalls';
    const POPULATION_POWER_CENTER = 'populationPowerCenter';
    const POPULATION_POWER_CENTER_MODIFIER = 'populationPowerCenterModifier';
    const POPULATION_SIZE = 'populationSize';
    const POPULATION_TYPE = 'PopulationTypeTable';
    const POPULATION_WARD_DENSITY = 'populationWardDensity';
    const POPULATION_WEALTH = 'populationWealth';
    const POWER_CENTER_ALIGNMENT = 'powerCenterAlignment';
    const POWER_CENTER_TYPE = 'powerCenterType';
    const POWER_CENTER_UNABSORBED = 'powerCenterUnabsorbed';
    const PROFESSION = 'profession';
    const PROFESSION_RATIO = 'professionRatio';
    const RACES = 'races';
    const RACES_PERCENTS = 'racesPercents';
    const RACES_RANDOM = 'racesRandom';
    const SYLLABLES = 'syllables';
    const WARD_ACRES_USED = 'wardAcresUsed';
    const WARDS = 'wards';

    /**
     * @param string $tableName
     * @return BaseTable
     */
    static public function getTable(string $tableName) {
        return new $tableName();
    }
}
