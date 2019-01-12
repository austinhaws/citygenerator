<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Controllers\CityGen\Constants\Table;
use App\Http\Controllers\CityGen\Tables\PopulationTypeTable;

class TableService
{

    private $populationTypeTable;

    public function __construct(PopulationTypeTable $populationTypeTable)
    {
        $this->populationTypeTable = $populationTypeTable;
    }

    /**
     * get value in a range
     *
     * @param string $tableName
     * @param int $index
     * @return mixed|null
     */
    function getTableResultRange(string $tableName, int $index) {
        $table = Table::getTable($tableName)->getTable();

        foreach ($table as $key => $value) {
            if ($index <= $key) {
                return $value;
            }
        }
        pprint_r(array('index' => $index, 'table' => $table), 'get_table_result_range : Index unknown', true);
        return null;
    }

    /**
     * get value at an index
     *
     * @param string $tableName
     * @param string|int $index
     * @return mixed
     */
    function getTableResultIndex(string $tableName, $index) {
        $table = Table::getTable($tableName)->getTable();

        if (!isset($table[$index])) {
            pprint_r(debug_backtrace(), 'backtrace');
            pprint_r(array('index' => $index, 'table' => $table), 'get_table_result_index : Index unknown', true);
        }
        return $table[$index];
    }

    /**
     * get a random table result
     *
     * @param string $tableName
     * @return mixed
     */
    function getTableResultRandom($tableName) {
        $table = Table::getTable($tableName)->getTable();

        do {
            $result = $table[rand_range(0, count($table) - 1)];
        } while (!$result);
        return $result;
    }

    /**
     * given a value, find which key has that value in range, see $table_population_size for an example table
     *
     * @param string $tableName a data table that is shaped as {key:{min:1, max: 5}, key:{min:6, max:10}}
     * @param int $value the value to find in a min/max range
     * @return string/boolean the key for which $value is valid, false if value isn't in a range
     */
    function getTableKeyFromRangeValue($tableName, $value) {
        $table = Table::getTable($tableName)->getTable();

        $result = false;
        foreach ($table as $key => $range) {
            if ($range[kMin] <= $value && $range[kMax] >= $value) {
                $result = $key;
                break;
            }
        }
        return $result;
    }
}
