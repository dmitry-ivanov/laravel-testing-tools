<?php

use Illuminate\Foundation\AliasLoader;

class FixtureServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->registerAliases();
        $this->registerCommands();
    }

    public function boot()
    {
        if (method_exists($this, 'loadMigrationsFrom')) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
        }
    }

    private function registerAliases()
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Acme\Alias\Post', Post::class);
        });
    }

    private function registerCommands()
    {
        $this->app->singleton('command.fixture.registered', RegisteredCommand::class);

        $this->commands(['command.fixture.registered']);
    }
}
