<?php

namespace Arados\Settings\Facades;

use Illuminate\Support\Facades\Facade;

class Settings extends Facade
{
    /**
     * Get facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'settings';
    }
}
