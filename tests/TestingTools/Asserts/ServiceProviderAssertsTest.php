<?php

namespace Illuminated\Testing\TestingTools\Tests\Asserts;

use Illuminated\Testing\TestingTools\Tests\TestCase;

class ServiceProviderAssertsTest extends TestCase
{
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
        $this->seeRegisteredCommand('registered');
    }

    /** @test */
    public function it_has_dont_see_registered_command_assertion()
    {
        $this->dontSeeRegisteredCommand('fake');
    }
}
