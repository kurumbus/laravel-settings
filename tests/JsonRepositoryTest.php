<?php

namespace Arados\Settings\Test;

use Arados\Settings\Repositories\JsonRepository;

class JsonRepositoryTest extends BaseRepositoryTest
{
    protected $path;

    protected $filesystem;

    public function setUp()
    {
        parent::setUp();

        $this->path = sys_get_temp_dir().'/settings.json';
        $this->filesystem = $this->app['files'];
        $this->settings = new JsonRepository($this->filesystem, $this->path);
    }

    public function tearDown()
    {
        parent::tearDown();
        if ($this->filesystem->exists($this->path)) {
            $this->filesystem->delete($this->path);
        }
    }
}
