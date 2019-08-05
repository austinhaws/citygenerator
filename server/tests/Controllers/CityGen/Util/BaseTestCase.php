<?php

namespace Test\Controllers\CityGen\Util;

use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    /** @var TestServicesService */
    protected $services;
    /** @var DB the db connection */
    private static $db;

    public function __construct()
    {
        parent::__construct();
        $this->services = new TestServicesService($this);
    }

    public function setUp()
    {
        parent::setup();

        if (!self::$db) {
            // probably a way to use Database.php in config? but this does the trick...
            self::$db = new DB;
            self::$db->addConnection(array(
                'driver' => 'mysql',
                'host' => env('DB_CITYGEN_HOST'),
                'port' => env('DB_CITYGEN_PORT'),
                'database' => env('DB_CITYGEN_DATABASE'),
                'username' => env('DB_CITYGEN_USERNAME'),
                'password' => env('DB_CITYGEN_PASSWORD'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => false,
            ), 'citygen');

            self::$db->setAsGlobal();
            self::$db->bootEloquent();
        }
    }

    protected function assertIsSorted($array, $getSortValueCallback)
    {
        $values = array_map(function ($object) use($getSortValueCallback) { return $getSortValueCallback($object); }, $array);
        $isSorted = array_reduce($values, function ($carry, $value) {
            if ($carry !== null) {
                // strings must be string sorted
                if (((($carry !== null && is_string($carry)) || ($carry === null && is_string($value))) && strcmp($value, $carry) >= 0) ||
                    // numbers must be number sorted
                    ((($carry !== null && !is_string($carry)) || ($carry === null && !is_string($value))) && $value >= $carry)
                ) {
                    $carry = $value;
                } else {
                    $carry = null;
                }
            }
            return $carry;
        }, '');
        $this->assertNotNull($isSorted, "If null then a value is not sorted correctly");
    }
}
