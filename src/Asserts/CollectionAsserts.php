<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Collection;

trait CollectionAsserts
{
    protected function assertCollectionsEqual(Collection $collection1, Collection $collection2, $key)
    {
        $keys1 = $collection1->pluck($key)->toArray();
        $keys2 = $collection2->pluck($key)->toArray();

        $diff1 = array_diff($keys1, $keys2);
        $diff2 = array_diff($keys2, $keys1);

        $bothDiffsAreEmpty = (empty($diff1) && empty($diff2));
        $this->assertTrue($bothDiffsAreEmpty, 'Failed asserting that collections are equal.');
    }

    protected function assertCollectionsNotEqual(Collection $collection1, Collection $collection2, $key)
    {
        $keys1 = $collection1->pluck($key)->toArray();
        $keys2 = $collection2->pluck($key)->toArray();

        $diff1 = array_diff($keys1, $keys2);
        $diff2 = array_diff($keys2, $keys1);

        $atLeastOneDiffIsNotEmpty = (!empty($diff1) || !empty($diff2));
        $this->assertTrue($atLeastOneDiffIsNotEmpty, 'Failed asserting that collections are not equal.');
    }
}
