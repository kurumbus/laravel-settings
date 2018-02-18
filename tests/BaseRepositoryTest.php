<?php

namespace Smartisan\Settings\Test;

use Orchestra\Testbench\TestCase;

abstract class BaseRepositoryTest extends TestCase
{
    protected $settings;

    /** @test */
    public function test_settings_are_empty()
    {
        $this->assertEquals(0, count($this->settings->get()));
    }

    /** @test */
    public function test_set_method()
    {
        $this->settings->set('k1', 'v1');
        $this->assertEquals(1, count($this->settings->get()));
    }

    /** @test */
    public function test_get_method()
    {
        $this->settings->set('k1', 'v1');
        $actual = $this->settings->get('k1');
        $this->assertEquals('v1', $actual);
    }

    /** @test */
    public function test_has_method()
    {
        $this->settings->set('k1', 'v1');
        $this->assertTrue($this->settings->has('k1'));
    }

    /** @test */
    public function test_forget_method()
    {
        $this->settings->set('k1', 'v1');
        $this->settings->forget('k1');
        $this->assertEquals(0, count($this->settings->get()));
    }

    /** @test */
    public function test_flush_method()
    {
        $this->settings->set('k1', 'v1');
        $this->settings->flush();
        $this->assertEquals(0, count($this->settings->get()));
    }
}
