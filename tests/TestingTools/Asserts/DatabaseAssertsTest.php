<?php

namespace Illuminated\Testing\TestingTools\Tests\Asserts;

use Illuminated\Testing\TestingTools\Tests\TestCase;
use Orchestra\Database\ConsoleServiceProvider;
use Post;

class DatabaseAssertsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase();
        $this->setUpFactories();
        $this->loadMigrations();
        $this->seedDatabase();
    }

    protected function getPackageProviders($app)
    {
        if (class_exists(ConsoleServiceProvider::class)) {
            return [ConsoleServiceProvider::class];
        }

        return [];
    }

    protected function setUpDatabase()
    {
        config(['database.default' => 'testing']);
    }

    private function setUpFactories()
    {
        $this->withFactories(__DIR__ . '/../fixture/database/factories');
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => __DIR__ . '/../fixture/database/migrations',
        ]);
    }

    private function seedDatabase()
    {
        factory(Post::class)->create(['title' => 'First Post']);
        factory(Post::class)->create(['title' => 'Second Post']);
        factory(Post::class)->create(['title' => 'Third Post']);
    }

    /** @test */
    public function it_has_see_database_table_assertion()
    {
        $this->seeDatabaseTable('posts');
    }

    /** @test */
    public function it_has_dont_see_database_table_assertion()
    {
        $this->dontSeeDatabaseTable('unicorns');
    }

    /** @test */
    public function it_has_see_in_database_many_assertion()
    {
        $this->seeInDatabaseMany('posts', [
            ['title' => 'First Post'],
            ['title' => 'Second Post'],
            ['title' => 'Third Post'],
        ]);
    }

    /** @test */
    public function it_has_dont_see_in_database_many_assertion()
    {
        $this->dontSeeInDatabaseMany('posts', [
            ['title' => 'Fourth Post'],
            ['title' => 'Fifth Post'],
        ]);
    }
}
