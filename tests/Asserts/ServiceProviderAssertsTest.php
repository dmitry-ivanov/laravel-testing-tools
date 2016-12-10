<?php

use Illuminated\Testing\Asserts\ServiceProviderAsserts;

class ServiceProviderAssertsTest extends TestCase
{
    use ServiceProviderAsserts;

    protected function getPackageProviders($app)
    {
        return [FixtureServiceProvider::class];
    }

    /** @test */
    public function it_has_command_registered_assertion()
    {
        $this->assertCommandRegistered('generic');
    }

    /** @test */
    public function it_has_command_not_registered_assertion()
    {
        $this->assertCommandNotRegistered('unexisting');
    }

    /** @test */
    public function it_has_alias_registered_assertion()
    {
        $this->assertAliasRegistered('Fixture\Alias\Post');
    }

    /** @test */
    public function it_has_alias_not_registered_assertion()
    {
        $this->assertAliasNotRegistered('Fixture\Alias\Unexisting');
    }
}
