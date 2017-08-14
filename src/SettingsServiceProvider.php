<?php

namespace Arados\Settings;

use Illuminate\Support\ServiceProvider;
use Arados\Settings\Console\MakeTableCommand;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSettings();
        $this->registerCommands();
    }

    /**
     * Boot registered package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
    }

    /**
     * Register settings.
     *
     * @return void
     */
    protected function registerSettings()
    {
        $this->app->singleton('settings.manager', function ($app) {
            return new SettingsManager($app);
        });

        $this->app->singleton('settings', function ($app) {
            $repository = $this->app['settings.manager']->driver();

            if ($app['config']->get('settings.cache.enable')) {
                $repository->setCacher($app['cache']);
            }

            return $repository;
        });
    }

    /**
     * Register package console commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands(MakeTableCommand::class);
    }

    /**
     * Register package configuration.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $path = realpath(__DIR__.'/../config/settings.php');
        $this->mergeConfigFrom($path, 'settings');
        $this->publishes([$path => config_path('settings.php')], 'config');
    }
}
