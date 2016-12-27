<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Artisan;

trait ServiceProviderAsserts
{
    protected function seeRegisteredAlias($alias)
    {
        $message = "Failed asserting that alias `{$alias}` is registered.";
        $this->assertNotEmpty(AliasLoader::getInstance()->load($alias), $message);
    }

    protected function dontSeeRegisteredAlias($alias)
    {
        $message = "Failed asserting that alias `{$alias}` is not registered.";
        $this->assertEmpty(AliasLoader::getInstance()->load($alias), $message);
    }

    protected function assertCommandRegistered($name)
    {
        $message = "Failed asserting that command `{$name}` is registered.";
        $this->assertArrayHasKey($name, Artisan::all(), $message);
    }

    protected function assertCommandNotRegistered($name)
    {
        $message = "Failed asserting that command `{$name}` is not registered.";
        $this->assertArrayNotHasKey($name, Artisan::all(), $message);
    }
}
