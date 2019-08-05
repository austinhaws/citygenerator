<?php

namespace App\Http\Controllers\CityGen\Models\Table;

use App\Http\Controllers\CityGen\Models\Table\Base\TableCityGen;

class TableCommodity extends TableCityGen
{
    protected $table = 'commodities';

    /** @var int */
    public $range;

    /** @var string */
    public $name;
}
