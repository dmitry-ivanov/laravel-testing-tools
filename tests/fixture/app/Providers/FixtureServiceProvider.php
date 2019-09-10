<?php

namespace Illuminated\TestingTools\Tests\Fixture\App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminated\TestingTools\Tests\Fixture\App\Post;
use Illuminated\TestingTools\Tests\Fixture\App\Console\Commands\RegisteredCommand;

class FixtureServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerAliases();
        $this->registerCommands();
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
