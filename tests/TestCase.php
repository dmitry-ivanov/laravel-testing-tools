<?php

namespace Illuminated\Testing\Tests;

use Illuminate\Contracts\Console\Kernel as KernelContract;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminated\Testing\TestingTools;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestingTools;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->setUpFactories();
        $this->setUpStorage();
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
        ])->assertSuccessful();
    }

    /**
     * Setup factories.
     */
    private function setUpFactories(): void
    {
        Factory::useNamespace('Illuminated\\Testing\\Tests\\Database\\Factories\\');
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
     */
    protected function resolveApplicationConsoleKernel($app): void
    {
        parent::resolveApplicationConsoleKernel($app);

        app(KernelContract::class);
    }

    /**
     * Assert that class uses the given trait.
     */
    protected function assertTraitUsed(string $class, string $trait): void
    {
        $message = "Failed asserting that class `{$class}` is using trait `{$trait}`.";
        $this->assertContains($trait, class_uses($class), $message);
    }
}
