<?php

namespace App\Http\Controllers\CityGen;

use App\Http\Common\Services\ServicesService;
use Laravel\Lumen\Routing\Controller as BaseController;

class CityGenController extends BaseController //extends ControllerBase
{
    private $services;

    public function __construct(ServicesService $servicesService)
    {
        $this->services = $servicesService;
    }

    public function getLists() {
        return $this->services->lists->getLists();
    }

    public function generate(\Illuminate\Http\Request $request) {
	    $postData = $this->services->postData->createPostData($request->json()->all());
        $city = $this->services->randomCity->randomizeCity($postData);
        return response()->json(json_encode($city));
    }
}
