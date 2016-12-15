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

    /** @test */
    public function it_has_see_artisan_table_output_assertion()
    {
        $this->artisan('table-output');

        $this->seeArtisanTableOutput([
            ['System' => 'Node-1', 'Status' => 'Enabled'],
            ['System' => 'Node-2', 'Status' => 'Enabled'],
            ['System' => 'Node-3', 'Status' => 'Enabled'],
        ]);
    }

    /** @test */
    public function it_has_dont_see_artisan_table_output_assertion()
    {
        $this->artisan('table-output');

        $this->dontSeeArtisanTableOutput([
            ['System' => 'Node-1', 'Status' => 'Disabled'],
            ['System' => 'Node-2', 'Status' => 'Disabled'],
            ['System' => 'Node-3', 'Status' => 'Disabled'],
        ]);
    }
}
