<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Settings Driver
    |--------------------------------------------------------------------------
    |
    | Default settings storage driver. Supported drivers: "file", "database"
    |
    */
    'default' => env('SETTINGS_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Enable or disable settings cache.
    |
    */
    'cache'   => [
        'enable' => true,
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
