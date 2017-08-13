<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Settings Driver
    |--------------------------------------------------------------------------
    |
    | Here you can define the default driver to store settings.
    |
    | Supported: "file", "database"
    |
    */
    'default' => env('SETTINGS_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Enable or disable settings cache. Expiration time is in minutes.
    |
    */
    'cache'   => [
        'enable'          => false,
        'expiration_time' => 60 * 24
    ],

    /*
    |--------------------------------------------------------------------------
    | Settings Drivers
    |--------------------------------------------------------------------------
    |
    | Configure settings driver.
    |
    */
    'drivers' => [
        'json'     => [
            'path' => storage_path('settings.json'),
        ],
        'database' => [
            'table' => 'settings',
        ],
    ],
];
