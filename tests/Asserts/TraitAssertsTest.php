<?php

use Illuminate\Notifications\Notifiable;

class TraitAssertsTest extends TestCase
{
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
