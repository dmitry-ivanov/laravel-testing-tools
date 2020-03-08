<?php

namespace Illuminated\Testing\Helpers;

use Illuminate\Support\Facades\App;

trait ApplicationHelpers
{
    /**
     * Emulate that application is running on the `local` environment.
     *
     * @return void
     */
    protected function emulateLocal()
    {
        $this->emulateEnvironment('local');
    }

    /**
     * Emulate that application is running on the `production` environment.
     *
     * @return void
     */
    protected function emulateProduction()
    {
        $this->emulateEnvironment('production');
    }

    /**
     * Emulate that application is running on the given environment.
     *
     * @param string $environment
     * @return void
     */
    protected function emulateEnvironment(string $environment)
    {
        App::detectEnvironment(function () use ($environment) {
            return $environment;
        });
    }

    /**
     * Check whether application is running on Travis or not.
     *
     * @return bool
     */
    protected function isTravis()
    {
        return (bool) getenv('TRAVIS');
    }
}
