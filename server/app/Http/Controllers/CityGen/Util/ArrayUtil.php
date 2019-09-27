<?php
namespace App\Http\Controllers\CityGen\Util;

/**
 * Class ArrayUtil
 * functions that php lacks for arrays
 */
class ArrayUtil
{
    /**
     * @param array $arr
     * @param callable $func
     * @return mixed|null
     */
    public static function array_find_idx($arr, $func) {
        $result = null;
        foreach ($arr as $idx => $item) {
            if (call_user_func($func, $item) === true) {
                $result = $idx;
                break;
            }
        }
        return $result;
    }

}
