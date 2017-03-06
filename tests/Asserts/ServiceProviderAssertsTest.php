<?php

use Illuminated\Testing\Tests\TestCase;

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
    public function it_has_dont_see_registered_alias_assertion()
    {
        $this->dontSeeRegisteredAlias('Acme\Alias\Fake');
    }

    /** @test */
    public function it_has_see_registered_command_assertion()
    {
        $this->seeRegisteredCommand('generic');
    }

    /** @test */
    public function it_has_dont_see_registered_command_assertion()
    {
        $this->dontSeeRegisteredCommand('fake');
    }
}
