<?php

return [
    'default'     => 'homestead',
    'connections' => [
        'homestead' => [
            'driver'    => env('HOMESTEAD_CONNECTION'),
            'host'      => env('HOMESTEAD_HOST'),
            'port'      => env('HOMESTEAD_PORT'),
            'database'  => env('HOMESTEAD_DATABASE'),
            'username'  => env('HOMESTEAD_USERNAME'),
            'password'  => env('HOMESTEAD_PASSWORD'),
            'charset'   => env('HOMESTEAD_CHARSET'),
            'collation' => env('HOMESTEAD_COLLATION'),
        ],
        'framework' => [
            'driver'    => env('FRAMEWORK_CONNECTION'),
            'host'      => env('FRAMEWORK_HOST'),
            'port'      => env('FRAMEWORK_PORT'),
            'database'  => env('FRAMEWORK_DATABASE'),
            'username'  => env('FRAMEWORK_USERNAME'),
            'password'  => env('FRAMEWORK_PASSWORD'),
            'charset'   => env('FRAMEWORK_CHARSET'),
            'collation' => env('FRAMEWORK_COLLATION'),
        ],
    ],
];
