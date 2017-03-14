<?php

namespace Illuminated\Testing\TestingTools\Tests\Asserts;

use FixtureServiceProvider;
use Illuminated\Testing\TestingTools\Tests\TestCase;

class ServiceProviderAssertsTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return array_merge(
            parent::getPackageProviders($app),
            [FixtureServiceProvider::class]
        );
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
