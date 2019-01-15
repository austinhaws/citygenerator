<?php

namespace Test\Controllers\CityGen\Util;

use App\Http\Controllers\CityGen\Services\ServicesService;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    /** @var ServicesService */
    protected $services;

    public function __construct()
    {
        parent::__construct();
        $this->services = new TestServicesService();
    }
}
