<?php

namespace Illuminated\Testing\Tests\App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminated\Testing\Tests\App\Console\Commands\RegisteredCommand;
use Illuminated\Testing\Tests\App\Post;

class FixtureServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerAliases();
        $this->registerCommands();
    }

    /**
     * Register aliases.
     */
    private function registerAliases(): void
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Acme\Alias\Post', Post::class);
        });
    }

    /**
     * Register commands.
     */
    private function registerCommands(): void
    {
        $this->app->singleton('command.fixture.registered', RegisteredCommand::class);

        $this->commands(['command.fixture.registered']);
    }
}
