<?php

namespace Illuminated\Testing\Tests;

use Illuminate\Contracts\Console\Kernel as KernelContract;
use Illuminate\Database\Eloquent\Factories\Factory;
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
     */
    protected function setUpDatabase(): void
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
     */
    private function setUpFactories(): void
    {
        Factory::useNamespace('Illuminated\\Testing\\Tests\\Database\\Factories\\');
    }

    /**
     * Setup views.
     */
    private function setUpViews(): void
    {
        app('view')->addLocation(__DIR__ . '/fixture/resources/views');
    }

    /**
     * Setup storage.
     */
    private function setUpStorage(): void
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
