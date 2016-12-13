<?php

use Illuminate\Notifications\Notifiable;
use Illuminated\Testing\Asserts\TraitAsserts;

class TraitAssertsTest extends TestCase
{
    use TraitAsserts;

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
