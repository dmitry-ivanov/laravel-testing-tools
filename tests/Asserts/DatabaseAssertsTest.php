<?php

namespace Illuminated\TestingTools\Tests\Asserts;

use Illuminated\TestingTools\Tests\TestCase;
use Illuminated\TestingTools\Tests\Fixture\App\Post;

class DatabaseAssertsTest extends TestCase
{
    /** @test */
    public function it_has_database_has_table_assertion()
    {
        $this->assertDatabaseHasTable('posts');
    }

    /** @test */
    public function it_has_database_missing_table_assertion()
    {
        $this->assertDatabaseMissingTable('unicorns');
    }

    /** @test */
    public function it_has_database_has_many_assertion()
    {
        factory(Post::class)->create(['title' => 'First Post']);
        factory(Post::class)->create(['title' => 'Second Post']);
        factory(Post::class)->create(['title' => 'Third Post']);

        $this->assertDatabaseHasMany('posts', [
            ['title' => 'First Post'],
            ['title' => 'Second Post'],
            ['title' => 'Third Post'],
        ]);
    }

    /** @test */
    public function it_has_database_missing_many_assertion()
    {
        $this->assertDatabaseMissingMany('posts', [
            ['title' => 'Fourth Post'],
            ['title' => 'Fifth Post'],
        ]);
    }
}
