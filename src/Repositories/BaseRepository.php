<?php

namespace Arados\Settings\Repositories;

use Illuminate\Support\Arr;
use Arados\Settings\Contracts\Settings;
use Arados\Settings\Contracts\Repository;

abstract class BaseRepository implements Repository
{
    /**
     * Settings data.
     *
     * @var array
     */
    protected $settings = [];

    /**
     * Used to check if settings are loaded from storage.
     *
     * @var bool
     */
    protected $loaded = false;

    /**
     * Caching repository.
     *
     * @var Repository
     */
    protected $cache;

    /**
     * Caching key used to store settings.
     *
     * @var string
     */
    protected $cacheKey = 'arados.settings.cache';

    /**
     * Set caher instance.
     *
     * @param $cacher Repository
     */
    public function setCacher($cacher)
    {
        $this->cache = $cacher;
    }

    /**
     * Check if given settings key exists.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        $this->isLoaded();

        return Arr::has($this->settings, $key);
    }

    /**
     * Set given settings values.
     *
     * @param string|array $key
     * @param null|string|array $value
     * @return void
     */
    public function set($key, $value = null)
    {
        $this->isLoaded();

        if (empty($value) && is_array($key)) {
            foreach ($key as $k => $v) {
                Arr::set($this->settings, $k, $v);
            }
        } else {
            Arr::set($this->settings, $key, $value);
        }

        $this->write();
        $this->flushCache();
    }

    /**
     * Get settings values.
     *
     * @param null|string $key
     * @param null|string $default
     * @return string
     */
    public function get($key = null, $default = null)
    {
        $this->isLoaded();

        if ($key == null) {
            return $this->settings;
        }

        return Arr::get($this->settings, $key, $default);
    }

    /**
     * Remove setting value(s).
     *
     * @param string $key
     * @return void
     */
    public function forget($key)
    {
        $this->isLoaded();

        Arr::forget($this->settings, $key);

        $this->write();
        $this->flushCache();
    }

    /**
     * Remove all settings.
     *
     * @return void
     */
    public function flush()
    {
        $this->isLoaded();

        $this->settings = [];

        $this->flushCache();
        $this->write();
    }

    /**
     * Check if settings are loaded from the storage.
     *
     * @return void
     */
    protected function isLoaded()
    {
        if ($this->loaded) {
            return;
        }

        if ($this->isCachingEnabled()) {
            $this->settings = $this->cache->get($this->cacheKey, []);

            if (empty($this->settings)) {
                $this->cache->rememberForever($this->cacheKey, function () {
                    return $this->settings = $this->read();
                });
            }
        } else {
            $this->settings = $this->read();
        }

        $this->loaded = true;
    }

    /**
     * Check if caching is enabled.
     *
     * @return bool
     */
    protected function isCachingEnabled()
    {
        return ! is_null($this->cache);
    }

    /**
     * Flush cached settings.
     *
     * @return void
     */
    protected function flushCache()
    {
        if ($this->isCachingEnabled()) {
            $this->cache->forget($this->cacheKey);
        }
    }
}
