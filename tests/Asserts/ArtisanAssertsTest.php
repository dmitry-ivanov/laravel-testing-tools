<?php

use Illuminated\Testing\Asserts\ArtisanAsserts;

class ArtisanAssertsTest extends TestCase
{
    use ArtisanAsserts;

    /** @test */
    public function it_has_see_artisan_output_assertion()
    {
        $this->artisan('generic');

        $this->seeArtisanOutput('Hello, World!');
    }

    /** @test */
    public function it_has_dont_see_artisan_output_assertion()
    {
        $this->artisan('generic');

        $this->dontSeeArtisanOutput('Hello, Universe!');
    }
}
