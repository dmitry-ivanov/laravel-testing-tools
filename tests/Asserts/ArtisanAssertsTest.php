<?php

class ArtisanAssertsTest extends TestCase
{
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

    /** @test */
    public function it_has_see_artisan_table_rows_count_assertion()
    {
        $this->artisan('table-output');

        $this->seeArtisanTableRowsCount(3);
    }

    /** @test */
    public function it_has_dont_see_artisan_table_rows_count_assertion()
    {
        $this->artisan('table-output');

        $this->dontSeeArtisanTableRowsCount(1);
        $this->dontSeeArtisanTableRowsCount(2);
        $this->dontSeeArtisanTableRowsCount(4);
        $this->dontSeeArtisanTableRowsCount(5);
    }
}
