<?php

namespace Illuminated\Testing\Asserts;

trait ReflectionAsserts
{
    protected function assertSubclassOf($class, $parent)
    {
        $message = "Failed asserting that class `{$class}` is subclass of `{$parent}`.";
        $this->assertTrue(is_subclass_of($class, $parent), $message);
    }

    protected function assertNotSubclassOf($class, $parent)
    {
        $message = "Failed asserting that class `{$class}` is not subclass of `{$parent}`.";
        $this->assertFalse(is_subclass_of($class, $parent), $message);
    }

    protected function assertTraitUsed($class, $trait)
    {
        $message = "Failed asserting that class `{$class}` is using trait `{$trait}`.";
        $this->assertContains($trait, class_uses($class), $message);
    }

    protected function assertTraitNotUsed($class, $trait)
    {
        $message = "Failed asserting that class `{$class}` is not using trait `{$trait}`.";
        $this->assertNotContains($trait, class_uses($class), $message);
    }
}
