<?php

use Illuminated\Testing\Tests\TestCase;

class ApplicationHelpersTest extends TestCase
{
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

    /** @test */
    public function it_can_emulate_any_environment()
    {
        $this->emulateEnvironment('demo');

        $this->assertEquals('demo', $this->app->environment());
    }

    /** @test */
    public function it_can_check_if_tests_are_running_on_travis()
    {
        $expected = (bool) getenv('TRAVIS');
        $this->assertEquals($expected, $this->isTravis());
    }
}
