<?php

namespace App\Http\Common\Controllers;

use App\Http\Common\Services\ServicesService;
use Laravel\Lumen\Routing\Controller as BaseController;

class ControllerBase extends BaseController
{
    /** @var ServicesService */
	protected $services;

	public function __construct(ServicesService $servicesService)
	{
        $this->services = $servicesService;
	}
}
