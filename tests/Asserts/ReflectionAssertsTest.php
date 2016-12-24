<?php

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        $this->assertTraitUsed(Post::class, Notifiable::class);
    }

    /** @test */
    public function it_has_trait_not_used_assertion()
    {
        $this->assertTraitNotUsed(Post::class, 'Acme\Trait\Fake');
    }
}
