<?php

namespace App\Http\Common\Tables;

abstract class BaseTable
{

    /**
     * @return array the actual table
     */
    abstract function getTable();
}
