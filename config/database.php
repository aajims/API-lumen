<?php

return [

    'default' => 'homestead',

    /*
    |--------------------------------------------------------------------------
    | No table name set on execute migration in Lumen.
    |--------------------------------------------------------------------------
    |
    | @see https://stackoverflow.com/questions/32879392/no-table-name-set-on-execute-migration-in-lumen
    |
    */

    'migrations' => 'migrations',

    'connections' => [
        'homestead' => [
            'read'      => [
                'host' => env('HOMESTEAD_HOST'),
            ],
            'write'     => [
                'host' => env('HOMESTEAD_HOST'),
            ],
            'driver'    => env('HOMESTEAD_CONNECTION'),
            'sticky'    => env('HOMESTEAD_STICKY'),
            'port'      => env('HOMESTEAD_PORT'),
            'database'  => env('HOMESTEAD_DATABASE'),
            'username'  => env('HOMESTEAD_USERNAME'),
            'password'  => env('HOMESTEAD_PASSWORD'),
            'charset'   => env('HOMESTEAD_CHARSET'),
            'collation' => env('HOMESTEAD_COLLATION'),
            'prefix'    => env('HOMESTEAD_PREFIX'),
        ],
        'framework' => [
            'read'      => [
                'host' => env('HOMESTEAD_HOST'),
            ],
            'write'     => [
                'host' => env('HOMESTEAD_HOST'),
            ],
            'driver'    => env('FRAMEWORK_CONNECTION'),
            'sticky'    => env('FRAMEWORK_STICKY'),
            'port'      => env('FRAMEWORK_PORT'),
            'database'  => env('FRAMEWORK_DATABASE'),
            'username'  => env('FRAMEWORK_USERNAME'),
            'password'  => env('FRAMEWORK_PASSWORD'),
            'charset'   => env('FRAMEWORK_CHARSET'),
            'collation' => env('FRAMEWORK_COLLATION'),
            'prefix'    => env('FRAMEWORK_PREFIX'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [
        'client'  => 'predis',
        'cluster' => false,
        'default' => [
            'host'               => env('REDIS_HOST', '127.0.0.1'),
            'port'               => env('REDIS_PORT', 6379),
            'database'           => 0,
            'read_write_timeout' => 60,
            'parameters'         => [
                'password' => env('REDIS_PASSWORD', ''),
            ],
        ],
    ],

];
