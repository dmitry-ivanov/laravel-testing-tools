<?php

namespace Illuminated\Testing\Tests\Helpers;

use Illuminated\Testing\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ApplicationHelpersTest extends TestCase
{
    #[Test]
    public function it_can_emulate_local_environment(): void
    {
        $this->emulateLocal();

        $this->assertEquals('local', $this->app->environment());
    }

    #[Test]
    public function it_can_emulate_production_environment(): void
    {
        $this->emulateProduction();

        $this->assertEquals('production', $this->app->environment());
    }

    #[Test]
    public function it_can_emulate_any_environment(): void
    {
        $this->emulateEnvironment('demo');

        $this->assertEquals('demo', $this->app->environment());
    }
}
