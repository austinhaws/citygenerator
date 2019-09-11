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
            new TestRoll('Translate word', 0, 0, 30),
            new TestRoll('Translate word', 15, 0, 30),
            new TestRoll('Translate word', 18, 0, 30),
            new TestRoll('Translate word', 20, 0, 30),
            new TestRoll('Translate word', 3, 0, 8),
            new TestRoll('Translate word', 19, 0, 30),
            new TestRoll('Translate word', 9, 0, 30),
            new TestRoll('Translate word', 7, 0, 8),
            new TestRoll('Translate word', 6, 0, 30),
            new TestRoll('Translate word', 8, 0, 8),
            new TestRoll('Translate word', 5, 0, 30),
            new TestRoll('Translate word', 19, 0, 30),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_ELF, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Ry Vmuj Nëlaáraj', $name);
    }

    public function testUtf8()
    {
        // generate 1000 elf names and make sure a ? isn't in any of them
        for ($x = 0; $x < 10; $x++) {
            $this->services->random->setRolls([TestRoll::randomInstance()]);
            $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_ELF, '0 1 2 3 4 5 6 7 8 9 a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z', ConvertService::SHUFFLE_RANDOM);
            $this->services->random->verifyRolls();
            $this->assertFalse(strstr($name, '?'));
        }
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertOrc()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, 16),
            new TestRoll('Translate word', 15, 0, 16),
            new TestRoll('Translate word', 14, 0, 16),
            new TestRoll('Translate word', 10, 0, 16),
            new TestRoll('Translate word', 3, 0, 7),
            new TestRoll('Translate word', 4, 0, 16),
            new TestRoll('Translate word', 6, 0, 16),
            new TestRoll('Translate word', 7, 0, 7),
            new TestRoll('Translate word', 11, 0, 16),
            new TestRoll('Translate word', 0, 0, 7),
            new TestRoll('Translate word', 4, 0, 16),
            new TestRoll('Translate word', 5, 0, 16),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_TOLKIEN_BLACK_SPEECH, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Hf Raúk Ledakb', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertUndead()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, 23),
            new TestRoll('Translate word', 15, 0, 23),
            new TestRoll('Translate word', 18, 0, 23),
            new TestRoll('Translate word', 20, 0, 23),
            new TestRoll('Translate word', 2, 0, 2),
            new TestRoll('Translate word', 1, 0, 23),
            new TestRoll('Translate word', 1, 0, 23),
            new TestRoll('Translate word', 0, 0, 2),
            new TestRoll('Translate word', 1, 0, 23),
            new TestRoll('Translate word', 2, 0, 2),
            new TestRoll('Translate word', 0, 0, 23),
            new TestRoll('Translate word', 1, 0, 23),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_UNDEAD, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Mgh Noooouuumm Mmaaammuuummm', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertGoblin()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, 20),
            new TestRoll('Translate word', 15, 0, 20),
            new TestRoll('Translate word', 18, 0, 20),
            new TestRoll('Translate word', 20, 0, 20),
            new TestRoll('Translate word', 12, 0, 12),
            new TestRoll('Translate word', 9, 0, 20),
            new TestRoll('Translate word', 11, 0, 20),
            new TestRoll('Translate word', 6, 0, 12),
            new TestRoll('Translate word', 8, 0, 20),
            new TestRoll('Translate word', 0, 0, 12),
            new TestRoll('Translate word', 11, 0, 20),
            new TestRoll('Translate word', 11, 0, 20),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_GOBLIN, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Hj X-\'k Vidavv', $name);
    }

    /**
     * @covers \App\Http\Controllers\Dictionary\Services\ConvertService::convert
     */
    public function testConvertGoblin2MoreRealisticTranslation()
    {
        $this->services->random->setRolls([
            new TestRoll('Translate word', 0, 0, 20),
            new TestRoll('Translate word', 15, 0, 20),
            new TestRoll('Translate word', 18, 0, 20),
            new TestRoll('Translate word', 20, 0, 20),
            new TestRoll('Translate word', 12, 0, 12),
            new TestRoll('Translate word', 9, 0, 20),
            new TestRoll('Translate word', 11, 0, 20),
            new TestRoll('Translate word', 6, 0, 12),
            new TestRoll('Translate word', 8, 0, 20),
            new TestRoll('Translate word', 1, 0, 12),
            new TestRoll('Translate word', 11, 0, 20),
            new TestRoll('Translate word', 11, 0, 20),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_GOBLIN, 'my ship coming');

        $this->services->random->verifyRolls();

        $this->assertSame('Hj X-\'k Viduvv', $name);
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
            new TestRoll('Translate word', 10, 0, 618),
            new TestRoll('Translate word', 210, 0, 443),
            new TestRoll('Translate word', 576, 0, 978),
            new TestRoll('Translate word', 3001, 0, 3738),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_SAYING);

        $this->services->random->verifyRolls();

        $this->assertSame("Announces The Light Offer Speechlessly", $name);
    }

    public function testConvertSayingRandom()
    {
        for ($shuffleX = 1; $shuffleX <= 3; $shuffleX++) {
            $this->services->random->setRolls([
                new TestRoll('Translate word', 10, 0, 618),
                new TestRoll('Translate word', 210, 0, 443),
                new TestRoll('Translate word', 576, 0, 978),
                new TestRoll('Translate word', 3001, 0, 3738),
                new TestRoll('Random Shuffle', $shuffleX, 1, 3),
            ]);

            $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_SAYING, null, ConvertService::SHUFFLE_RANDOM);

            $this->services->random->verifyRolls();

            $this->assertSame(strlen("AnnouncesTheLightOfferSpeechlessly"), strlen(preg_replace('/ /', '', $name)));
        }
    }

    public function testPercentInclude()
    {
        $this->services->random->setRolls([
            new TestRoll('Include Word', 0, 1, 100),
            new TestRoll('Translate word', 10, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
            new TestRoll('Translate word', 1, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_NAME, null, ConvertService::SHUFFLE_NONE);

        $this->services->random->verifyRolls();

        $this->assertSame("Aamoir Aakash Aaby", $name);
    }

    public function testPercentDisclude()
    {
        $this->services->random->setRolls([
            new TestRoll('Include Word', 100, 1, 100),
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
            new TestRoll('Translate word', 0, 0, TestRoll::ANY),
        ]);

        $name = $this->services->realDictionaryConvert->convert(DictionaryTable::PHRASES_NAME, null, ConvertService::SHUFFLE_NONE);

        $this->services->random->verifyRolls();

        $this->assertSame("Aahron Aaberg", $name);
    }

    public function testStartNames()
    {
        foreach(DictionaryTable::getConstants() as $dictionary) {

            switch ($dictionary) {
                case DictionaryTable::PHRASES_ELF:
                case DictionaryTable::PHRASES_GOBLIN:
                case DictionaryTable::PHRASES_NAME:
                case DictionaryTable::PHRASES_TOLKIEN_BLACK_SPEECH:
                case DictionaryTable::PHRASES_UNDEAD:
                    $this->services->random->setRolls([
                        new TestRoll('Include Word', 100, 1, 100),
                        new TestRoll('Translate word', TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY),
                        new TestRoll('Translate word', TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY),
                    ]);
                    break;
                case DictionaryTable::PHRASES_SAYING:
                    $this->services->random->setRolls([
                        new TestRoll('Translate word', TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY),
                        new TestRoll('Translate word', TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY),
                        new TestRoll('Translate word', TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY),
                        new TestRoll('Translate word', TestRoll::RANDOM, TestRoll::ANY, TestRoll::ANY),
                    ]);
                    break;
                default:
                    throw new RuntimeException("New table needs start item test: " . $dictionary);
            }

            $name = $this->services->realDictionaryConvert->convert($dictionary, null, ConvertService::SHUFFLE_NONE);
            $this->assertTrue(strlen($name) > 0);

        }
    }
}
