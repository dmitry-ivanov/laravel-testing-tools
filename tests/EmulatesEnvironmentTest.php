<?php

use Illuminated\Testing\EmulatesEnvironment;

class EmulatesEnvironmentTest extends TestCase
{
    use EmulatesEnvironment;

    /** @test */
    public function it_can_emulate_local_environment()
    {
        $this->emulateLocal();
        $this->assertEquals('local', $this->app->environment());
    }

    /** @test */
    public function it_can_emulate_production_environment()
    {
        $this->emulateProduction();
        $this->assertEquals('production', $this->app->environment());
    }
}
