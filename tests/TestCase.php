<?php

namespace Illuminated\Testing\Tests;

use Illuminate\Contracts\Console\Kernel as KernelContract;
use Illuminated\Testing\TestingTools;
use Illuminated\Testing\Tests\App\Console\Kernel;
use Illuminated\Testing\Tests\App\Providers\FixtureServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestingTools;

    /**
     * Indicates if the console output should be mocked.
     *
     * @var bool
     */
    public $mockConsoleOutput = false;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->setUpFactories();
        $this->setUpViews();
        $this->setUpStorage();
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [FixtureServiceProvider::class];
    }

    /**
     * Setup the database.
     *
     * @return void
     */
    protected function setUpDatabase()
    {
        config(['database.default' => 'testing']);
        config(['database.connections.testing.foreign_key_constraints' => true]);

        $this->artisan('migrate', [
            '--database' => 'testing',
            '--realpath' => true,
            '--path' => __DIR__ . '/fixture/database/migrations/',
        ]);
        $this->seeInArtisanOutput('Migrated');
    }

    /**
     * Setup factories.
     *
     * @return void
     */
    private function setUpFactories()
    {
        $this->withFactories(__DIR__ . '/fixture/database/factories');
    }

    /**
     * Setup views.
     *
     * @return void
     */
    private function setUpViews()
    {
        app('view')->addLocation(__DIR__ . '/fixture/resources/views');
    }

    /**
     * Setup storage.
     *
     * @return void
     */
    private function setUpStorage()
    {
        $this->app->useStoragePath(__DIR__ . '/fixture/storage');
    }

    /**
     * Resolve application Console Kernel implementation.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function resolveApplicationConsoleKernel($app)
    {
        $app->singleton(KernelContract::class, Kernel::class);

        app(KernelContract::class);
    }
}
