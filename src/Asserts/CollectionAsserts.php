<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Collection;

trait CollectionAsserts
{
    /**
     * Assert that the given collections are equal based on the specified key.
     */
    protected function assertCollectionsEqual(Collection $collection1, Collection $collection2, string $key): void
    {
        $this->assertEquals(
            $collection1->pluck($key)->sort()->values(),
            $collection2->pluck($key)->sort()->values(),
            'Failed asserting that collections are equal.',
        );
    }

    /**
     * Assert that the given collections are not equal based on the specified key.
     */
    protected function assertCollectionsNotEqual(Collection $collection1, Collection $collection2, string $key): void
    {
        $this->assertNotEquals(
            $collection1->pluck($key)->sort()->values(),
            $collection2->pluck($key)->sort()->values(),
            'Failed asserting that collections are not equal.',
        );
    }
}
