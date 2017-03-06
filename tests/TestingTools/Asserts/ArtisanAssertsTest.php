<?php

use Illuminated\Testing\TestingTools\Tests\TestCase;

class ArtisanAssertsTest extends TestCase
{
    /** @test */
    public function it_has_will_see_confirmation_assertion()
    {
        $this->willSeeConfirmation('Are you sure?', ConfirmationCommand::class);
    }

    /** @test */
    public function which_also_works_with_confirmable_trait()
    {
        $this->willSeeConfirmation('Do you really wish to run this command?', ConfirmableTraitCommand::class);
    }

    /** @test */
    public function it_has_will_not_see_confirmation_assertion()
    {
        $this->willNotSeeConfirmation('Are you sure?', GenericCommand::class);
    }

    /** @test */
    public function it_has_will_give_confirmation_assertion()
    {
        $this->willGiveConfirmation('Are you sure?', ConfirmationCommand::class);

        $this->seeArtisanOutput('Done!');
    }

    /** @test */
    public function which_is_also_works_with_confirmable_trait()
    {
        $this->willGiveConfirmation('Do you really wish to run this command?', ConfirmableTraitCommand::class);

        $this->seeArtisanOutput(__DIR__ . '/ArtisanAssertsTest/confirmable.accepted.output.txt');
    }

    /** @test */
    public function it_has_will_not_give_confirmation_assertion()
    {
        $this->willNotGiveConfirmation('Are you sure?', ConfirmationCommand::class);

        $this->dontSeeArtisanOutput(__DIR__ . '/ArtisanAssertsTest/confirmable.accepted.output.txt');
    }

    /** @test */
    public function it_has_see_artisan_output_assertion()
    {
        $this->artisan('generic');

        $this->seeArtisanOutput('Hello, World!');
    }

    /** @test */
    public function which_accepts_file_path_instead_of_string_output()
    {
        $this->artisan('generic');

        $this->seeArtisanOutput(__DIR__ . '/ArtisanAssertsTest/generic.correct.output.txt');
    }

    /** @test */
    public function it_has_dont_see_artisan_output_assertion()
    {
        $this->artisan('generic');

        $this->dontSeeArtisanOutput('Hello, Universe!');
    }

    /** @test */
    public function which_also_accepts_file_path_instead_of_string_output()
    {
        $this->artisan('generic');

        $this->dontSeeArtisanOutput(__DIR__ . '/ArtisanAssertsTest/generic.incorrect.output.txt');
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
