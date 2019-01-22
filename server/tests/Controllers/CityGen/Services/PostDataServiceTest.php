<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\BooleanRandom;
use App\Http\Controllers\CityGen\Constants\PopulationType;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class PostDataServiceTest extends BaseTestCase
{

    public function testCreatePostData()
    {
        $postData = $this->services->postData->createPostData([
            'populationType' => PopulationType::LARGE_CITY,
            'sea' => BooleanRandom::TRUE,
            'military' => BooleanRandom::FALSE,
            'river' => BooleanRandom::RANDOM,
            'gates' => null,
        ]);

        $this->assertSame(BooleanRandom::TRUE, $postData->hasSea);
        $this->assertSame(BooleanRandom::FALSE, $postData->hasMilitary);
        $this->assertSame(BooleanRandom::RANDOM, $postData->hasRiver);
        $this->assertSame(BooleanRandom::RANDOM, $postData->hasGates);
    }

    public function testCreatePostData_BooleanRandom()
    {
        $postData = $this->services->postData->createPostData([
            'sea' => BooleanRandom::TRUE,
            'river' => BooleanRandom::RANDOM,
            'gates' => 'somethingunknown',
        ]);

        $this->assertSame(BooleanRandom::TRUE, $postData->hasSea);
        $this->assertSame(BooleanRandom::RANDOM, $postData->hasMilitary);
        $this->assertSame(BooleanRandom::RANDOM, $postData->hasRiver);
        $this->assertSame(BooleanRandom::RANDOM, $postData->hasGates);
    }
}
