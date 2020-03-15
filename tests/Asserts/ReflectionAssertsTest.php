<?php

namespace Illuminated\Testing\Tests\Asserts;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminated\Testing\Tests\App\Commentable;
use Illuminated\Testing\Tests\App\Post;
use Illuminated\Testing\Tests\TestCase;

class ReflectionAssertsTest extends TestCase
{
    /** @test */
    public function it_has_subclass_of_assertion()
    {
        $this->assertSubclassOf(Post::class, Model::class);
    }

    /** @test */
    public function it_has_not_subclass_of_assertion()
    {
        $this->assertNotSubclassOf(Post::class, Command::class);
    }

    /** @test */
    public function it_has_trait_used_assertion()
    {
        $this->assertTraitUsed(Post::class, Commentable::class);
    }

    /** @test */
    public function it_has_trait_not_used_assertion()
    {
        $this->assertTraitNotUsed(Post::class, 'Acme\Trait\Fake');
    }

    /** @test */
    public function it_has_method_exists_assertion()
    {
        $this->assertMethodExists(Post::class, 'save');
    }

    /** @test */
    public function it_has_method_not_exists_assertion()
    {
        $this->assertMethodNotExists(Post::class, 'fake');
    }
}
