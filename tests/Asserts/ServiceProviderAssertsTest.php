<?php

class ServiceProviderAssertsTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [FixtureServiceProvider::class];
    }

    /** @test */
    public function it_has_see_registered_alias_assertion()
    {
        $this->seeRegisteredAlias('Acme\Alias\Post');
    }

    /** @test */
    public function it_has_alias_not_registered_assertion()
    {
        $this->assertAliasNotRegistered('Acme\Alias\Fake');
    }

    /** @test */
    public function it_has_command_registered_assertion()
    {
        $this->assertCommandRegistered('generic');
    }

    /** @test */
    public function it_has_command_not_registered_assertion()
    {
        $this->assertCommandNotRegistered('fake');
    }
}
