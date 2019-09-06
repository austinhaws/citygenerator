<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Common\Models\MinMax;
use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Constants\Table;
use RuntimeException;

class TableService extends BaseService
{
    /**
     * get value in a range
     *
     * @param string $tableName
     * @return mixed|null
     */
    function getTableResultRange(string $tableName) {
        return $this->getTableResultRangeCustom("$tableName: range", Table::getTable($tableName)->getTable());
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
            var_dump(debug_backtrace(), 'backtrace');
            var_dump(array('index' => $index, 'table' => $table), 'get_table_result_index : Index unknown');
            exit('failed');
        }
        return $table[$index];
    }

    /**
     * get a random table result
     *
     * @param string $tableName
     * @return int
     */
    function getTableResultRandom($tableName) {
        return $this->getTableResultRangeCustom("getTableResultRandom-$tableName", Table::getTable($tableName)->getTable());
    }

    /**
     * get a random table result from a custom table (or sub-table of an existing table)
     *
     * @param string $rollName
     * @param array $table
     * @return mixed
     */
    function getTableResultRangeCustom(string $rollName, $table)
    {
        $keys = array_keys($table);
        // min 1, keys[0] is because range tables start with something like 200 meaning 1->200 are that key where as NameWordsTable is a plain array that starts with a zero index
        $index = $this->services->random->randMinMaxInt($rollName, new MinMax(min(1, $keys[0]), array_pop($keys)));

        foreach ($table as $key => $value) {
            if ($index <= $key) {
                return $value;
            }
        }
        $keys = implode(',', array_keys($table));
        throw new RuntimeException("index unknown for table and roll $rollName: $index\n($keys)\n");
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
            if ($range->min <= $value && $range->max >= $value) {
                $result = $key;
                break;
            }
        }
        return $result;
    }

    /**
     * @param string[] &$list
     * @param string table Table::...
     * @param int $total
     */
    function fillRandomStrings(&$list, $table, $total)
    {
        while (count($list) !== $total) {
            $entry = $this->services->table->getTableResultRange($table);
            if (array_search($entry, $list) === false) {
                $list[] = $entry;
            }
        }
        sort($list);
    }

}
