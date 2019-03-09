<?php

namespace Test\Controllers\CityGen\Util;

use App\Http\Common\Services\ServicesService;
use App\Http\Controllers\CityGen\Services\RandomCity\RandomService;
use App\Http\Controllers\CityGen\Util\TestRandomService;
use App\Http\Controllers\Dictionary\Services\ConvertService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TestServicesService extends ServicesService
{
    /** @var RandomService */
    public $realRandom;
    /** @var MockObject */
    public $convertMock;
    /** @var ConvertService */
    public $realDictionaryConvert;

    public function __construct(TestCase $testCase)
    {
        parent::__construct();

        $this->realRandom = new RandomService($this);
        $this->realDictionaryConvert = new ConvertService($this);
        $this->random = new TestRandomService($this);

        $this->dictionaryConvert = $this->convertMock = $testCase->getMockBuilder(ConvertService::class)
            ->disableOriginalConstructor()
            ->setMethods(['convert'])
            ->getMock();
    }
}
