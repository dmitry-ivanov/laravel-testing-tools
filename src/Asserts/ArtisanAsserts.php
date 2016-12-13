<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\Artisan;

trait ArtisanAsserts
{
    protected function seeArtisanOutput($output)
    {
        $expected = trim($output);
        $actual = trim(Artisan::output());
        $this->assertEquals($expected, $actual, "Failed asserting that artisan output is `{$expected}`.");
    }

    protected function dontSeeArtisanOutput($output)
    {
        $expected = trim($output);
        $actual = trim(Artisan::output());
        $this->assertNotEquals($expected, $actual, "Failed asserting that artisan output is not `{$expected}`.");
    }
}
