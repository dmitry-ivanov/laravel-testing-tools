<?php

namespace Illuminated\Testing\Asserts;

trait ReflectionAsserts
{
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
