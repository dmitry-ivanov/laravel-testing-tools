<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\Artisan;

trait ArtisanAsserts
{
    protected function seeArtisanOutput($output)
    {
        $output = trim($output);
        $this->assertEquals($output, Artisan::output(), "Failed asserting that artisan output is `{$output}`.");
    }

    protected function dontSeeArtisanOutput($output)
    {
        $output = trim($output);
        $this->assertNotEquals($output, Artisan::output(), "Failed asserting that artisan output is not `{$output}`.");
    }
}
