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
    public function which_accepts_file_path_as_output_parameter()
    {
        $this->artisan('generic');

        $this->seeArtisanOutput(__DIR__ . '/ArtisanAssertsTest/correct.output.txt');
    }

    /** @test */
    public function it_has_dont_see_artisan_output_assertion()
    {
        $this->artisan('generic');

        $this->dontSeeArtisanOutput('Hello, Universe!');
    }

    /** @test */
    public function which_also_accepts_file_path_as_output_parameter()
    {
        $this->artisan('generic');

        $this->dontSeeArtisanOutput(__DIR__ . '/ArtisanAssertsTest/incorrect.output.txt');
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
