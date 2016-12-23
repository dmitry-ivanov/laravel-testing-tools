<?php

namespace Illuminated\Testing\Helpers;

trait EmulatesEnvironment
{
    protected function emulateLocal()
    {
        $this->emulateEnvironment('local');
    }

    protected function emulateProduction()
    {
        $this->emulateEnvironment('production');
    }

    protected function emulateEnvironment($environment)
    {
        $this->app->detectEnvironment(function () use ($environment) {
            return $environment;
        });
    }
}
