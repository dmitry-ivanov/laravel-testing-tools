<?php

namespace Illuminated\Testing\Helpers;

trait ApplicationHelpers
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

    protected function isTravis()
    {
        return (bool) getenv('TRAVIS');
    }
}
