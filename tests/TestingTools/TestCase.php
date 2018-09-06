<?php

namespace Illuminated\Testing\TestingTools\Tests;

use FixtureServiceProvider;
use Illuminate\Contracts\Console\Kernel as KernelContract;
use Illuminate\Support\Facades\DB;
use Illuminated\Testing\TestingTools;
use Kernel;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestingTools;

    public $mockConsoleOutput = false;

    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->setUpFactories();
        $this->setUpViews();
        $this->setUpRoutes();
        $this->setUpStorage();
    }

    protected function getPackageProviders($app)
    {
        return [FixtureServiceProvider::class];
    }

    protected function setUpDatabase()
    {
        config(['database.default' => 'testing']);

        DB::statement('PRAGMA foreign_keys = ON');

        $this->artisan('migrate', [
            '--database' => 'testing',
            '--realpath' => true,
            '--path' => __DIR__ . '/fixture/database/migrations/',
        ]);
        $this->seeInArtisanOutput('Migrated');
    }

    private function setUpFactories()
    {
        $this->withFactories(__DIR__ . '/fixture/database/factories');
    }

    private function setUpViews()
    {
        app('view')->addLocation(__DIR__ . '/fixture/resources/views');
    }

    private function setUpRoutes()
    {
        app('router')->get('/', 'HomeController@index');
    }

    private function setUpStorage()
    {
        $this->app->useStoragePath(__DIR__ . '/fixture/storage');
    }

    protected function resolveApplicationConsoleKernel($app)
    {
        $app->singleton(KernelContract::class, Kernel::class);

        app(KernelContract::class);
    }
}
