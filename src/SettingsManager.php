<?php

namespace Smartisan\Settings;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Manager;
use Smartisan\Settings\Repositories\JsonRepository;
use Smartisan\Settings\Repositories\DatabaseRepository;

class SettingsManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config('default');
    }

    /**
     * Create JSON repository driver.
     *
     * @return JsonRepository
     */
    public function createJsonDriver()
    {
        $config = $this->config('drivers.json');

        return new JsonRepository($this->app['files'], $config['path']);
    }

    /**
     * Create database repository driver.
     *
     * @return DatabaseRepository
     */
    public function createDatabaseDriver()
    {
        $config = $this->config('drivers.database');
        $connection = isset($config['connection']) ? DB::connection($config['connection']) : $this->app['db'];

        return new DatabaseRepository($connection, $config['table']);
    }

    /**
     * Get package configuration by key.
     *
     * @param $key
     * @param null $default
     * @return array|string
     */
    public function config($key, $default = null)
    {
        return $this->app['config']->get('settings.'.$key, $default);
    }
}
