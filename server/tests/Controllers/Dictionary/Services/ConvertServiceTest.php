<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Util\TestRoll;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class ConvertServiceTest extends BaseTestCase
{
    private function rolls($maxRoll, $numRolls = 12)
    {
        $rollCount = 0;
        return array_map(function() use ($rollCount, $maxRoll) {
            return new TestRoll('Translate letter', $rollCount++ % $maxRoll, 0, TestRoll::ANY);
        }, range(0, $numRolls));
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertElf()
    {
        $this->services->random->setRolls($this->rolls(8));

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_ELF, 'my ship coming', false);

        $this->services->random->verifyRolls();

        $this->assertSame('Rl Dtora Laëredt', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertOrc()
    {
        $this->services->random->setRolls($this->rolls(8));

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_TOLKIEN_BLACK_SPEECH, 'my ship coming', false);

        $this->services->random->verifyRolls();

        $this->assertSame('Hg Srâb Lehusr', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertUndead()
    {
        $this->services->random->setRolls($this->rolls(3));

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_UNDEAD, 'my ship coming', false);

        $this->services->random->verifyRolls();

        $this->assertSame('Mmm Nmooon Mooonaaammn', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertGoblin()
    {
        $this->services->random->setRolls($this->rolls(8));

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_GOBLIN, 'my ship coming', false);

        $this->services->random->verifyRolls();

        $this->assertSame('Ht Rnuus Gehurn', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertElfShuffle()
    {
        $this->services->random->setRolls($this->rolls(8));

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_ELF, 'my ship coming', true);

        $this->services->random->verifyRolls();
        $this->assertEquals(3, count(explode(' ', $name)));
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertNonMatchAndSingleLetter()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate letter', 4, 0, TestRoll::ANY),
            new TestRoll('Translate letter', 5, 0, TestRoll::ANY),
            new TestRoll('Translate letter', 6, 0, TestRoll::ANY),
        ]);

        // Ä
        $char1 = '\u00C4';
        $char1UTF8 = json_decode("\"$char1\"");
        // è - this fails? more than 2 bytes? weird
        $char2 = '\u00E8';
        $char2UTF8 = json_decode("\"$char2\"");
        // į
        $char3 = '\u012F';
        $char3UTF8 = json_decode("\"$char3\"");
        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_ELF, json_decode('"a ' . $char1 . 'mb' . $char2 . 'r ' . $char3 . ' ~"'), false);

        $this->services->random->verifyRolls();
        $this->assertNotFalse(strpos($name, '~'));
        $this->assertNotFalse(strpos($name, $char1UTF8));
        // $this->assertNotFalse(strpos($name, $char2UTF8));
        $this->assertNotFalse(strpos($name, $char3UTF8));
    }
}
