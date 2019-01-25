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

    protected function assertIsSorted($array, $getSortValueCallback)
    {
        $values = array_map(function ($object) use($getSortValueCallback) { return $getSortValueCallback($object); }, $array);
        $isSorted = array_reduce($values, function ($carry, $value) {
            return $carry === null ? null : (strcmp($value, $carry) > 0 ? $value : null);
        }, '');
        $this->assertNotNull($isSorted);
    }
}
