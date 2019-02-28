<?php

namespace App\Http\Daos;

use Illuminate\Support\Facades\DB;

/*
// this is just an example and is not really used
class DictionaryDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct(BaseDao::$DB_DICTIONARY);
    }

	public function selectByGuid(string $guid)
	{
		return DB::table('account')->where('guid', '=', $guid)->first();
	}
}
 */

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
