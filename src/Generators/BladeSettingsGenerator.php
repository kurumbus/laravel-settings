<?php

namespace Arados\Settings\Generators;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Application;

class BladeSettingsGenerator
{
    /**
     * Laravel application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * BladeSettingsGenerator constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Generate javascript settings.
     *
     * @return string
     */
    public function generate()
    {
        $settings = $this->app['settings']->get();
        $jsHelper = file_get_contents(__DIR__.'/../../resources/js/settings.js');

        $whitelist = $this->app['config']->get('settings.whitelist');
        $blacklist = $this->app['config']->get('settings.blacklist');

        if (! empty($whitelist)) {
            $settings = Arr::only(Arr::dot($settings), $whitelist);
        }

        if (! empty($blacklist)) {
            $settings = Arr::except($settings, $blacklist);
        }

        $settings = json_encode($settings);

        return "<script>var settingsData = $settings; $jsHelper</script>";
    }
}
