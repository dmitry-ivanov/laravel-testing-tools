<?php

use Illuminated\Testing\Asserts\CollectionAsserts;

class CollectionAssertsTest extends TestCase
{
    use CollectionAsserts;

    /** @test */
    public function it_has_equal_collections_assertion()
    {
        $collection1 = collect([
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Jane Doe'],
            ['id' => 3, 'name' => 'Mary Doe'],
        ]);

        $collection2 = collect([
            ['id' => 3, 'name' => 'Mary Doe'],
            ['id' => 2, 'name' => 'Jane Doe'],
            ['id' => 1, 'name' => 'John Doe'],
        ]);

        $this->assertEqualCollections($collection1, $collection2, 'id');
    }

    /** @test */
    public function it_has_not_equal_collections_assertion()
    {
        $collection1 = collect([
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Jane Doe'],
            ['id' => 3, 'name' => 'Mary Doe'],
            ['id' => 4, 'name' => 'Jack Doe'],
        ]);

        $collection2 = collect([
            ['id' => 3, 'name' => 'Mary Doe'],
            ['id' => 2, 'name' => 'Jane Doe'],
            ['id' => 1, 'name' => 'John Doe'],
        ]);

        $this->assertNotEqualCollections($collection1, $collection2, 'id');
    }
}
