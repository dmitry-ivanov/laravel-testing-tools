<?php

namespace Illuminated\Testing\Tests\Asserts;

use Illuminated\Testing\Tests\App\Post;
use Illuminated\Testing\Tests\TestCase;

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
        Post::factory()->createMany([
            ['title' => 'First Post'],
            ['title' => 'Second Post'],
            ['title' => 'Third Post'],
        ]);

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
