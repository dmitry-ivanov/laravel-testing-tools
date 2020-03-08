<?php

namespace Illuminated\Testing\Asserts;

trait ReflectionAsserts
{
    /**
     * Assert that class is a subclass of the given parent.
     *
     * @param string $class
     * @param string $parent
     * @return void
     */
    protected function assertSubclassOf(string $class, string $parent)
    {
        $message = "Failed asserting that class `{$class}` is subclass of `{$parent}`.";
        $this->assertTrue(is_subclass_of($class, $parent), $message);
    }

    /**
     * Assert that class is not a subclass of the given parent.
     *
     * @param string $class
     * @param string $parent
     * @return void
     */
    protected function assertNotSubclassOf(string $class, string $parent)
    {
        $message = "Failed asserting that class `{$class}` is not subclass of `{$parent}`.";
        $this->assertFalse(is_subclass_of($class, $parent), $message);
    }

    /**
     * Assert that class uses the given trait.
     *
     * @param string $class
     * @param string $trait
     * @return void
     */
    protected function assertTraitUsed(string $class, string $trait)
    {
        $message = "Failed asserting that class `{$class}` is using trait `{$trait}`.";
        $this->assertContains($trait, class_uses($class), $message);
    }

    /**
     * Assert that class doesn't use the given trait.
     *
     * @param string $class
     * @param string $trait
     * @return void
     */
    protected function assertTraitNotUsed(string $class, string $trait)
    {
        $message = "Failed asserting that class `{$class}` is not using trait `{$trait}`.";
        $this->assertNotContains($trait, class_uses($class), $message);
    }

    /**
     * Assert that object has the given method.
     *
     * @param object|string $object
     * @param string $method
     * @return void
     */
    protected function assertMethodExists($object, string $method)
    {
        $message = "Failed asserting that `{$method}` method exists on specified object.";
        $this->assertTrue(method_exists($object, $method), $message);
    }

    /**
     * Assert that object doesn't have the given method.
     *
     * @param object|string $object
     * @param string $method
     * @return void
     */
    protected function assertMethodNotExists($object, string $method)
    {
        $message = "Failed asserting that `{$method}` method not exists on specified object.";
        $this->assertFalse(method_exists($object, $method), $message);
    }
}
