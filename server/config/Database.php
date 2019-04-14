<?php

return [

    // leave default blank so that the caller HAS to specify which database
   'default' => '',

   'connections' => [
       // citygen doesn't exist (yet)
        'citygen' => [
            'driver'    => 'mysql',
            'host'      => env('DB_CITYGEN_CONNECTION'),
            'port'      => env('DB_CITYGEN_PORT'),
            'database'  => env('DB_CITYGEN_DATABASE'),
            'username'  => env('DB_CITYGEN_USERNAME'),
            'password'  => env('DB_CITYGEN_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
         ],

        'dictionary' => [
            'driver'    => 'mysql',
            'host'      => env('DB_DICTIONARY_CONNECTION'),
            'port'      => env('DB_DICTIONARY_PORT'),
            'database'  => env('DB_DICTIONARY_DATABASE'),
            'username'  => env('DB_DICTIONARY_USERNAME'),
            'password'  => env('DB_DICTIONARY_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
    ],
];