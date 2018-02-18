<?php

namespace Smartisan\Settings\Repositories;

use Illuminate\Filesystem\Filesystem;

class JsonRepository extends BaseRepository
{
    /**
     * Filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Settings storage path.
     *
     * @var string
     */
    protected $path;

    /**
     * JsonRepository constructor.
     *
     * @param Filesystem $filesystem
     * @param $path string
     */
    public function __construct($filesystem, $path)
    {
        $this->filesystem = $filesystem;
        $this->path = $path;
    }

    /**
     * Read settings from the storage.
     *
     * @return array
     */
    public function read()
    {
        if ($this->filesystem->exists($this->path)) {
            return json_decode($this->filesystem->get($this->path), true);
        }
    }

    /**
     * Write settings to the storage.
     *
     * @return void
     */
    public function write()
    {
        $this->filesystem->put($this->path, json_encode($this->settings));
    }
}
