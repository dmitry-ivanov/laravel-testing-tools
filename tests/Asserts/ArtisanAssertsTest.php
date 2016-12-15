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
            ['Date' => '2016-12-13 13:13:13', 'System' => 'Alpha', 'Status' => 'Enabled'],
            ['Date' => '2016-12-14 14:14:14', 'System' => 'Beta', 'Status' => 'Enabled'],
            ['Date' => '2016-12-15 15:15:15', 'System' => 'Gamma', 'Status' => 'Disabled'],
        ]);
    }
}
