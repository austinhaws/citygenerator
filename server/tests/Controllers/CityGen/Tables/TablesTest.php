<?php

namespace Test\Controllers\CityGen\Tables;

use App\Http\Controllers\CityGen\Constants\Table;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

final class TablesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        try {
            $tables = (new ReflectionClass(Table::class))->getConstants();
            foreach ($tables as $tableName) {
                $table = Table::getTable($tableName);

                $this->assertNotEquals(0, count($table->getTable()));
            }
        } catch (\ReflectionException $e) {
            throw new RuntimeException($e);
        }


//        $this->get('/');
//
//        $this->assertEquals(
//            $this->app->version(), $this->response->getContent()
//        );
    }
}
