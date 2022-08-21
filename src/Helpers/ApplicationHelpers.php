<?php

namespace Illuminated\Testing\Helpers;

use Illuminate\Support\Facades\App;

trait ApplicationHelpers
{
    /**
     * Emulate that application is running on the `local` environment.
     */
    protected function emulateLocal(): void
    {
        $this->emulateEnvironment('local');
    }

    /**
     * Emulate that application is running on the `production` environment.
     */
    protected function emulateProduction(): void
    {
        $this->emulateEnvironment('production');
    }

    /**
     * Emulate that application is running on the given environment.
     */
    protected function emulateEnvironment(string $environment): void
    {
        App::detectEnvironment(function () use ($environment) {
            return $environment;
        });
    }
}
