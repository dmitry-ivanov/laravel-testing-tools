<?php

use Illuminate\Contracts\Console\Kernel as KernelContract;
use Illuminated\Testing\TestingTools;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestingTools;

    public function setUp()
    {
        parent::setUp();

        $this->setUpViews();
        $this->setUpRoutes();
        $this->setUpStorage();
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
