<?php

namespace App\Http\Common\Services;

class BaseService
{

    /**
     * @var ServicesService
     */
    protected $services;

    public function __construct(ServicesService $services)
    {
        $this->services = $services;
    }
}
