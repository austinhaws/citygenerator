<?php

namespace App\Http\Controllers\CityGen\Services\RandomCity;

use App\Http\Common\Services\BaseService;

class UTF8Service extends BaseService
{
    /**
     * @param string $str
     * @return array
     */
    public function explode(string $str)
    {
        return array_map(function ($i) use ($str) {
            return mb_substr($str, $i, 1);
        }, range(0, mb_strlen($str) - 1));
    }
}
