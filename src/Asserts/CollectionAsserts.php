<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Collection;

trait CollectionAsserts
{
    protected function assertEqualCollections(Collection $collection1, Collection $collection2, $key)
    {
        $collection1 = $collection1->pluck($key);
        $collection2 = $collection2->pluck($key);
        $diff = $collection1->diff($collection2);

        $this->assertEmpty($diff, 'Failed asserting that collections are equal.');
    }

    protected function assertNotEqualCollections(Collection $collection1, Collection $collection2, $key)
    {
        $collection1 = $collection1->pluck($key);
        $collection2 = $collection2->pluck($key);
        $diff = $collection1->diff($collection2);

        $this->assertNotEmpty($diff, 'Failed asserting that collections are not equal.');
    }
}
