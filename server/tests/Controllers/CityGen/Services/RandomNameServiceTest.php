<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\Race;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Util\TestRoll;
use App\Http\Controllers\Dictionary\Constants\DictionaryTable;
use App\Http\Controllers\Dictionary\Services\ConvertService;
use Test\Controllers\CityGen\Util\BaseTestCase;

final class RandomNameServiceTest extends BaseTestCase
{
    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService::generateName
     */
    public function testDictionaryNamesBlankDictionaryBasic()
    {
        $city = new City();

        $tests = [
            ['race' => Race::HUMAN, 'result' => 'Big'],
            ['race' => Race::HALFLING, 'result' => 'Big'],
            ['race' => Race::OTHER, 'result' => 'Big'],
        ];

        foreach ($tests as $test) {
            $this->services->random->setRolls([
                new TestRoll('Use words', 100, 1, 100),
                new TestRoll('NameNumWordsTable: range', 1, 1, 100),
                new TestRoll('getTableResultRandom-NameWordsTable', 10, 0, 1140),
                new TestRoll('Name has two words', 1, 1, 100),
                new TestRoll('Name has prefix', 1, 1, 100),
                new TestRoll('Name has suffix', 1, 1, 100),
            ]);
            $city->majorityRace = $test['race'];
            $this->services->randomName->generateName($city);

            $this->services->random->verifyRolls();

            $this->assertSame($test['result'], $city->name);
        }
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService::generateName
     */
    public function testDictionaryNamesHalfElf_Elf()
    {
        $city = new City();
        $city->majorityRace = Race::HALFELF;

        $this->services->convertMock->expects($this->once())
            ->method('convert')
            ->with($this->identicalTo(DictionaryTable::PHRASES_ELF), $this->identicalTo('bag slyd ville ti'), $this->identicalTo(ConvertService::SHUFFLE_RANDOM))
            ->willReturn('mocked value');

        $this->services->random->setRolls([
            new TestRoll('Name: half elf', 100, 1, 100),
            new TestRoll('NameNumWordsTable: range', 100, 1, 100),
            new TestRoll('NameNumSyllablesTable: range', 50, 1, 55),
            new TestRoll('SyllablesTable: range', 50, 1, 650),
            new TestRoll('NameNumSyllablesTable: range', 2, 1, 55),
            new TestRoll('SyllablesTable: range', 500, 1, 650),
            new TestRoll('NameNumSyllablesTable: range', 1, 1, 55),
            new TestRoll('SyllablesTable: range', 600, 1, 650),
            new TestRoll('NameNumSyllablesTable: range', 1, 1, 55),
            new TestRoll('SyllablesTable: range', 550, 1, 650),
        ]);
        $this->services->randomName->generateName($city);

        $this->services->random->verifyRolls();

        $this->assertSame('Mocked Value', $city->name);

    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService::generateName
     */
    public function testDictionaryNamesHalfElf_Human()
    {
        $city = new City();
        $city->majorityRace = Race::HALFELF;

        $this->services->random->setRolls([
            new TestRoll('Name: half elf', 1, 1, 100),
            new TestRoll('Use words', 100, 1, 100),
            new TestRoll('NameNumWordsTable: range', 1, 1, 100),
            new TestRoll('getTableResultRandom-NameWordsTable', 1100, 0, 1140),
            new TestRoll('Name has two words', 1, 1, 100),
            new TestRoll('Name has prefix', 1, 1, 100),
            new TestRoll('Name has suffix', 1, 1, 100),
        ]);
        $this->services->randomName->generateName($city);

        $this->services->random->verifyRolls();

        $this->assertSame('Wreckage', $city->name);

    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService::generateName
     */
    public function testDictionaryNamesHalfOrc_Orc()
    {
        $city = new City();
        $city->majorityRace = Race::HALFORC;

        $this->services->convertMock->expects($this->once())
            ->method('convert')
            ->with($this->identicalTo(DictionaryTable::PHRASES_TOLKIEN_BLACK_SPEECH), $this->identicalTo('bag slyd ville ti'), $this->identicalTo(ConvertService::SHUFFLE_RANDOM))
            ->willReturn('mocked value');

        $this->services->random->setRolls([
            new TestRoll('Name: half orc', 100, 1, 100),
            new TestRoll('NameNumWordsTable: range', 100, 1, 100),
            new TestRoll('NameNumSyllablesTable: range', 50, 1, 55),
            new TestRoll('SyllablesTable: range', 50, 1, 650),
            new TestRoll('NameNumSyllablesTable: range', 2, 1, 55),
            new TestRoll('SyllablesTable: range', 500, 1, 650),
            new TestRoll('NameNumSyllablesTable: range', 1, 1, 55),
            new TestRoll('SyllablesTable: range', 600, 1, 650),
            new TestRoll('NameNumSyllablesTable: range', 1, 1, 55),
            new TestRoll('SyllablesTable: range', 550, 1, 650),
        ]);
        $this->services->randomName->generateName($city);

        $this->services->random->verifyRolls();

        $this->assertSame('Mocked Value', $city->name);

    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService::generateName
     */
    public function testDictionaryNamesHalfOrc_Human()
    {
        $city = new City();
        $city->majorityRace = Race::HALFORC;

        $this->services->random->setRolls([
            new TestRoll('Name: half orc', 1, 1, 100),
            new TestRoll('Use words', 100, 1, 100),
            new TestRoll('NameNumWordsTable: range', 1, 1, 100),
            new TestRoll('getTableResultRandom-NameWordsTable', 1100, 0, 1140),
            new TestRoll('Name has two words', 1, 1, 100),
            new TestRoll('Name has prefix', 1, 1, 100),
            new TestRoll('Name has suffix', 1, 1, 100),
        ]);
        $this->services->randomName->generateName($city);

        $this->services->random->verifyRolls();

        $this->assertSame('Wreckage', $city->name);

    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService::generateName
     */
    public function testDictionaryNamesElf()
    {
        $city = new City();
        $city->majorityRace = Race::ELF;

        $this->services->convertMock->expects($this->once())
            ->method('convert')
            ->with($this->identicalTo(DictionaryTable::PHRASES_ELF), $this->identicalTo('bag'), $this->identicalTo(ConvertService::SHUFFLE_RANDOM))
            ->willReturn('mocked value');

        $this->services->random->setRolls([
            new TestRoll('NameNumWordsTable: range', 1, 1, 100),
            new TestRoll('NameNumSyllablesTable: range', 50, 1, 55),
            new TestRoll('SyllablesTable: range', 50, 1, 650),
        ]);
        $this->services->randomName->generateName($city);

        $this->services->random->verifyRolls();

        $this->assertSame('Mocked Value', $city->name);

    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService::generateName
     */
    public function testDictionaryNamesDwarfGnome()
    {
        $city = new City();

        $this->services->convertMock->expects($this->exactly(2))
            ->method('convert')
            ->with($this->identicalTo(DictionaryTable::PHRASES_GOBLIN), $this->identicalTo('bag'), $this->identicalTo(ConvertService::SHUFFLE_RANDOM))
            ->willReturn('mocked value');

        foreach ([Race::DWARF, Race::GNOME] as $race) {
            $city->majorityRace = $race;


            $this->services->random->setRolls([
                new TestRoll('NameNumWordsTable: range', 1, 1, 100),
                new TestRoll('NameNumSyllablesTable: range', 50, 1, 55),
                new TestRoll('SyllablesTable: range', 50, 1, 650),
            ]);
            $this->services->randomName->generateName($city);

            $this->services->random->verifyRolls();

            $this->assertSame('Mocked Value', $city->name);
        }
    }

    /**
     * @covers \App\Http\Controllers\CityGen\Services\RandomCity\RandomNameService::generateName
     */
    public function testUseNameWords()
    {
        $city = new City();

        $this->services->random->setRolls([
            new TestRoll('Use words', 100, 1, 100),
            new TestRoll('NameNumWordsTable: range', 1, 1, 100),
            new TestRoll('getTableResultRandom-NameWordsTable', 10, 0, 1140),
            new TestRoll('Name has two words', 76, 1, 100),
            new TestRoll('getTableResultRandom-NameWordsTable', 76, 0, 1140),
            new TestRoll('Name has prefix', 91, 1, 100),
            new TestRoll('getTableResultRandom-NamePrefixesTable', 5, 0, 5),
            new TestRoll('Name has suffix', 91, 1, 100),
            new TestRoll('getTableResultRandom-NameSuffixesTable', 13, 0, 13),
        ]);
        $city->majorityRace = Race::HUMAN;

        $this->services->randomName->generateName($city);

        $this->services->random->verifyRolls();

        $this->assertSame('Unbigcoastness', $city->name);
    }
}
