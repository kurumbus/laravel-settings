<?php

use Illuminate\Support\Facades\App;

if (! function_exists('settings')) {
    /**
     * Set or get settings.
     *
     * @param null|string|array $key
     * @param null|string $default
     * @return mixed
     */
    function settings($key = null, $default = null)
    {
        if (is_array($key)) {
            App::make('settings')->set($key);
        } else {
            return App::make('settings')->get($key, $default);
        }
    }
}
