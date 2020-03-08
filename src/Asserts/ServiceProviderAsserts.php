<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Artisan;

trait ServiceProviderAsserts
{
    /**
     * Assert that the given alias is registered.
     *
     * @param string $alias
     * @return void
     */
    protected function seeRegisteredAlias(string $alias)
    {
        $message = "Failed asserting that alias `{$alias}` is registered.";
        $this->assertNotEmpty(AliasLoader::getInstance()->load($alias), $message);
    }

    /**
     * Assert that the given alias is not registered.
     *
     * @param string $alias
     * @return void
     */
    protected function dontSeeRegisteredAlias(string $alias)
    {
        $message = "Failed asserting that alias `{$alias}` is not registered.";
        $this->assertEmpty(AliasLoader::getInstance()->load($alias), $message);
    }

    /**
     * Assert that the given command is registered.
     *
     * @param string $name
     * @return void
     */
    protected function seeRegisteredCommand(string $name)
    {
        $message = "Failed asserting that command `{$name}` is registered.";
        $this->assertArrayHasKey($name, Artisan::all(), $message);
    }

    /**
     * Assert that the given command is not registered.
     *
     * @param string $name
     * @return void
     */
    protected function dontSeeRegisteredCommand(string $name)
    {
        $message = "Failed asserting that command `{$name}` is not registered.";
        $this->assertArrayNotHasKey($name, Artisan::all(), $message);
    }
}
