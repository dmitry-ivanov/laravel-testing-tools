<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Artisan;

trait ServiceProviderAsserts
{
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

    protected function assertAliasRegistered($alias)
    {
        $message = "Failed asserting that alias `{$alias}` is registered.";
        $this->assertTrue(AliasLoader::getInstance()->load($alias), $message);
    }

    protected function assertAliasNotRegistered($alias)
    {
        $message = "Failed asserting that alias `{$alias}` is not registered.";
        $this->assertFalse(AliasLoader::getInstance()->load($alias), $message);
    }
}
