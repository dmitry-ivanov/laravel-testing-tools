<?php

namespace Illuminated\Testing\Tests\Asserts;

use Illuminated\Testing\Tests\App\Post;
use Illuminated\Testing\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DatabaseAssertsTest extends TestCase
{
    #[Test]
    public function it_has_database_has_table_assertion(): void
    {
        $this->assertDatabaseHasTable('posts');
    }

    #[Test]
    public function it_has_database_missing_table_assertion(): void
    {
        $this->assertDatabaseMissingTable('unicorns');
    }

    #[Test]
    public function it_has_database_has_many_assertion(): void
    {
        Post::factory()->create(['title' => 'First Post']);
        Post::factory()->create(['title' => 'Second Post']);
        Post::factory()->create(['title' => 'Third Post']);

        $this->assertDatabaseHasMany('posts', [
            ['title' => 'First Post'],
            ['title' => 'Second Post'],
            ['title' => 'Third Post'],
        ]);
    }

    #[Test]
    public function it_has_database_missing_many_assertion(): void
    {
        $this->assertDatabaseMissingMany('posts', [
            ['title' => 'Fourth Post'],
            ['title' => 'Fifth Post'],
        ]);
    }
}
