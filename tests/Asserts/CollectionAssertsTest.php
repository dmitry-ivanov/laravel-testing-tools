<?php

use Illuminated\Testing\Tests\TestCase;

class CollectionAssertsTest extends TestCase
{
    /** @test */
    public function it_has_collections_equal_assertion()
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

        $this->assertCollectionsEqual($collection1, $collection2, 'id');
    }

    /** @test */
    public function it_has_collections_not_equal_assertion()
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

        $this->assertCollectionsNotEqual($collection1, $collection2, 'id');
    }
}
