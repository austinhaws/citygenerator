<?php

namespace App\Http\Daos;

use Illuminate\Support\Facades\DB;

abstract class BaseDao
{
    public static $DB_DICTIONARY;
    public static $DB_CITYGEN;

    private $dbName;
    public function __construct(string $dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * @return \Illuminate\Database\ConnectionInterface connection pointing to specific database
     */
    protected function db()
    {
        return DB::connection($this->dbName);
    }
}

BaseDao::$DB_DICTIONARY = config('DB_DICTIONARY');
BaseDao::$DB_CITYGEN = config('DB_CITYGEN');
