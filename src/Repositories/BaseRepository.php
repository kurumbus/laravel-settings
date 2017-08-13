<?php

namespace Arados\Settings\Repositories;

use Arados\Settings\Contracts\Repository;
use Arados\Settings\Contracts\Settings;

abstract class BaseRepository implements Repository
{
    /**
     * Settings data.
     *
     * @var array
     */
    protected $settings = [];

    /**
     * Whether settings are loaded or not.
     *
     * @var bool
     */
    protected $loaded = false;

    /**
     * Check if settings are loaded from the storage.
     *
     * @return void
     */
    protected function isLoaded()
    {
        if (!$this->loaded) {
            $this->settings = $this->load();
            $this->loaded = true;
        }
    }
}
