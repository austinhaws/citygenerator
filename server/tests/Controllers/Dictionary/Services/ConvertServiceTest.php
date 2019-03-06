<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Util\TestRoll;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;
use App\Http\Controllers\Dictionary\Services\ConvertService;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class ConvertServiceTest extends BaseTestCase
{
    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertElf()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 15, 0, TestRoll::ANY),
            new TestRoll('Translate word', 18, 0, TestRoll::ANY),
            new TestRoll('Translate word', 20, 0, TestRoll::ANY),
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 19, 0, TestRoll::ANY),
            new TestRoll('Translate word', 9, 0, TestRoll::ANY),
            new TestRoll('Translate word', 7, 0, 8),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 8, 0, TestRoll::ANY),
            new TestRoll('Translate word', 5, 0, TestRoll::ANY),
            new TestRoll('Translate word', 19, 0, TestRoll::ANY),
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 2, 0, TestRoll::ANY),
            new TestRoll('Translate word', 4, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_ELF, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Ry Vmuj Nëäjuihl', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertOrc()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 15, 0, TestRoll::ANY),
            new TestRoll('Translate word', 18, 0, 10),
            new TestRoll('Translate word', 20, 0, 10),
            new TestRoll('Translate word', 3, 0, 10),
            new TestRoll('Translate word', 19, 0, 10),
            new TestRoll('Translate word', 9, 0, 10),
            new TestRoll('Translate word', 7, 0, 8),
            new TestRoll('Translate word', 6, 0, 10),
            new TestRoll('Translate word', 8, 0, 10),
            new TestRoll('Translate word', 5, 0, 10),
            new TestRoll('Translate word', 19, 0, 10),
            new TestRoll('Translate word', 3, 0, 10),
            new TestRoll('Translate word', 2, 0, 10),
            new TestRoll('Translate word', 4, 0, 10),
            new TestRoll('Translate word', 1, 0, 10),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_TOLKIEN_BLACK_SPEECH, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Hh Hhah Hahahh', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertUndead()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 15, 0, TestRoll::ANY),
            new TestRoll('Translate word', 18, 0, TestRoll::ANY),
            new TestRoll('Translate word', 20, 0, TestRoll::ANY),
            new TestRoll('Translate word', 2, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 2, 0, TestRoll::ANY),
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 2, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_UNDEAD, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Mm Mmaaam Maaamaaamm', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertGoblin()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 15, 0, TestRoll::ANY),
            new TestRoll('Translate word', 18, 0, TestRoll::ANY),
            new TestRoll('Translate word', 20, 0, TestRoll::ANY),
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 12, 0, 12),
            new TestRoll('Translate word', 9, 0, TestRoll::ANY),
            new TestRoll('Translate word', 11, 0, TestRoll::ANY),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 8, 0, TestRoll::ANY),
            new TestRoll('Translate word', 16, 0, TestRoll::ANY),
            new TestRoll('Translate word', 11, 0, TestRoll::ANY),
            new TestRoll('Translate word', 11, 0, TestRoll::ANY),
            new TestRoll('Translate word', 11, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_GOBLIN, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Hj X-\'rv Ggfvvv', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertGoblin2MoreRealisticTranslation()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 15, 0, TestRoll::ANY),
            new TestRoll('Translate word', 18, 0, TestRoll::ANY),
            new TestRoll('Translate word', 20, 0, TestRoll::ANY),
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 12, 0, 12),
            new TestRoll('Translate word', 9, 0, TestRoll::ANY),
            new TestRoll('Translate word', 11, 0, TestRoll::ANY),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 8, 0, TestRoll::ANY),
            new TestRoll('Translate word', 16, 0, TestRoll::ANY),
            new TestRoll('Translate word', 11, 0, TestRoll::ANY),
            new TestRoll('Translate word', 11, 0, TestRoll::ANY),
            new TestRoll('Translate word', 11, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_GOBLIN, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Hj X-\'rv Ggfvvv', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertElfShuffle()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 15, 0, TestRoll::ANY),
            new TestRoll('Translate word', 18, 0, TestRoll::ANY),
            new TestRoll('Translate word', 20, 0, TestRoll::ANY),
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 19, 0, TestRoll::ANY),
            new TestRoll('Translate word', 9, 0, TestRoll::ANY),
            new TestRoll('Translate word', 7, 0, 8),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 8, 0, TestRoll::ANY),
            new TestRoll('Translate word', 5, 0, TestRoll::ANY),
            new TestRoll('Translate word', 19, 0, TestRoll::ANY),
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 2, 0, TestRoll::ANY),
            new TestRoll('Translate word', 4, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_ELF, 'my ship coming', ConvertService::SHUFFLE_WORD);

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
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 4, 0, TestRoll::ANY),
            new TestRoll('Translate word', 5, 0, TestRoll::ANY),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 3, 0, TestRoll::ANY),
            new TestRoll('Translate word', 4, 0, TestRoll::ANY),
            new TestRoll('Translate word', 5, 0, TestRoll::ANY),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
            new TestRoll('Translate word', 6, 0, TestRoll::ANY),
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
        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_ELF, json_decode('"a ' . $char1 . 'mb' . $char2 . 'r ' . $char3 . ' ~"'));

        $this->services->random->verifyRolls();
        $this->assertNotFalse(strpos($name, '~'));
        $this->assertNotFalse(strpos($name, $char1UTF8));
        // $this->assertNotFalse(strpos($name, $char2UTF8));
        $this->assertNotFalse(strpos($name, $char3UTF8));
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertSaying()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 10, 0, 618),
            new TestRoll('Translate word', 210, 0, 443),
            new TestRoll('Translate word', 576, 0, 978),
            new TestRoll('Translate word', 3001, 0, 3738),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_SAYING);

        $this->services->random->verifyRolls();

        $this->assertSame("{name} Announces The Light Offer Speechlessly", $name);
    }

    public function testConvertSayingRandom()
    {
        for ($shuffleX = 1; $shuffleX <= 3; $shuffleX++) {
            $this->services->random->setRolls([
                new TestRoll('Translate word', 0, 0, TestRoll::ANY),
                new TestRoll('Translate word', 10, 0, 618),
                new TestRoll('Translate word', 210, 0, 443),
                new TestRoll('Translate word', 576, 0, 978),
                new TestRoll('Translate word', 3001, 0, 3738),
                new TestRoll('Random Shuffle', $shuffleX, 1, 3),
            ]);

            $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_SAYING, null, ConvertService::SHUFFLE_RANDOM);

            $this->services->random->verifyRolls();

            $this->assertSame(strlen("{name}AnnouncesTheLightOfferSpeechlessly"), strlen(preg_replace('/ /', '', $name)));
        }
    }

    public function testPercentInclude()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 10, 0, TestRoll::ANY),
            new TestRoll('Translate Percent', 1, 1, 100),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_NAME, null, ConvertService::SHUFFLE_NONE);

        $this->services->random->verifyRolls();

        $this->assertSame("Abigayle Aberah B", $name);
    }

    public function testPercentDisclude()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 10, 0, TestRoll::ANY),
            new TestRoll('Translate Percent', 100, 1, 100),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_NAME, null, ConvertService::SHUFFLE_NONE);

        $this->services->random->verifyRolls();

        $this->assertSame("Abigayle B", $name);
    }
}
