<?php

namespace Arados\Settings\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;

class MakeTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:table';

    /**
     * Laravel application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * MakeTableCommand constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct();

        $this->app = $app;
    }

    /**
     * Execute console command.
     *
     * @return void
     */
    public function fire()
    {
        $table = $this->app['config']->get('settings.drivers.database.table');
        $stub = $this->app['files']->get(realpath(__DIR__.'/stubs/migration.stub'));

        $stub = str_replace('{table}', $table, $stub);
        $name = date('Y_m_d_hms_').'create_settings_table.php';

        $this->app['files']->put(database_path('migrations/'.$name), $stub);

        $this->info('Settings migration is created. Don\'t forget to migrate!');
    }
}
