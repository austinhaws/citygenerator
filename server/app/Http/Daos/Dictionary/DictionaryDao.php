<?php

namespace App\Http\Daos\Dictionary;

use App\Http\Daos\BaseDao;
use Illuminate\Support\Facades\DB;

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

	public function selectById(int $id)
	{
		return DB::table('account')->where('id', '=', $id)->first();
	}

	/**
	 * @param $phrase string phrase unique for this account
	 * @return object account record
	 */
	public function insert($phrase)
	{
		return $this->selectById(DB::table('account')->insertGetId([
			'guid' => uniqid(),
			'phrase' => $phrase,
		]));
	}

	public function selectByPhrase($phrase)
	{
		return DB::table('account')->where('phrase', '=', $phrase)->first();
	}
}
