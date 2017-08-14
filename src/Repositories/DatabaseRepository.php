<?php

namespace Arados\Settings\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Database\DatabaseManager;

class DatabaseRepository extends BaseRepository
{
    /**
     * Database manager instance.
     *
     * @var DatabaseManager
     */
    protected $database;

    /**
     * Repository database table name.
     *
     * @var string
     */
    protected $table;

    /**
     * DatabaseRepository constructor.
     *
     * @param $database
     * @param $table
     */
    public function __construct($database, $table)
    {
        $this->database = $database;
        $this->table = $table;
    }

    /**
     * Read settings from the storage.
     *
     * @return array
     */
    public function read()
    {
        $settings = $this->database->table($this->table)
            ->pluck('value', 'key')->toArray();

        $data = [];

        foreach ($settings as $key => $value) {
            Arr::set($data, $key, $value);
        }

        return $data;
    }

    /**
     * Write settings to the storage.
     *
     * @return void
     */
    public function write()
    {
        $this->database->table($this->table)->delete();

        foreach (Arr::dot($this->settings) as $key => $value) {
            $this->database->table($this->table)
                ->updateOrInsert(['key' => $key], [
                    'key'   => $key,
                    'value' => $value,
                ]);
        }
    }
}
