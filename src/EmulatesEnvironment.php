<?php

namespace Illuminated\Testing;

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

    private function emulateEnvironment($environment)
    {
        $this->app->detectEnvironment(function () use ($environment) {
            return $environment;
        });
    }
}
