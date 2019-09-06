<?php

namespace App\Http\Controllers\CityGen;

use App\Http\Common\Services\ServicesService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class CityGenController extends BaseController //extends ControllerBase
{
    public $services;

    public function __construct(ServicesService $servicesService)
    {
        $this->services = $servicesService;
    }

    public function getLists() {
        return $this->services->lists->getLists();
    }

    public function generate(Request $request) {
	    $postData = $this->services->postData->createPostData($request->json()->all());
        $city = $this->services->randomCity->randomizeCity($postData);
        return response(json_encode($city));
    }
}
