<?php

namespace App\Http\Controllers\CityGen;

use App\Http\Controllers\CityGen\Services\ListsService;
use Laravel\Lumen\Routing\Controller as BaseController;

class ListsController extends BaseController
{
	private $listsService;

	public function __construct(ListsService $listsService)
	{
		$this->listsService = $listsService;
	}

	public function getLists() {
		return $this->listsService->getLists();
    }
}
