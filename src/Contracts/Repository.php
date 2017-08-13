<?php

namespace Arados\Settings\Contracts;

interface Repository
{
    /**
     * Read settings from the storage.
     *
     * @return array
     */
    public function read();

    /**
     * Write settings to the storage.
     *
     * @return void
     */
    public function write();
}
