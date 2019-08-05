<?php

namespace App\Http\Controllers\CityGen\Tables;

use App\Http\Common\Tables\BaseTable;

class DBTable extends BaseTable
{
    /** @var array the table data from the DB */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    function getTable()
    {
        return $this->data ;
    }
}
