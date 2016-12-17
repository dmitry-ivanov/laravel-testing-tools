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

    protected function seeArtisanTableOutput(array $data)
    {
        $message = 'Failed asserting that artisan table output consists of expected data.';
        $this->assertEquals($data, $this->parseArtisanTableOutput(Artisan::output()), $message);
    }

    protected function dontSeeArtisanTableOutput(array $data)
    {
        $message = 'Failed asserting that artisan table output not consists of expected data.';
        $this->assertNotEquals($data, $this->parseArtisanTableOutput(Artisan::output()), $message);
    }

    protected function seeArtisanTableRowsCount($count)
    {
        $message = "Failed asserting that artisan table rows count is equals to `{$count}`.";
        $this->assertEquals($count, count($this->parseArtisanTableOutput(Artisan::output())), $message);
    }

    protected function dontSeeArtisanTableRowsCount($count)
    {
        $message = "Failed asserting that artisan table rows count is not equals to `{$count}`.";
        $this->assertNotEquals($count, count($this->parseArtisanTableOutput(Artisan::output())), $message);
    }

    private function parseArtisanTableOutput($output)
    {
        $parsed = [];

        $headers = [];
        $outputRows = explode("\n", trim($output));
        foreach ($outputRows as $row) {
            if (!str_contains($row, '|')) {
                continue;
            }

            $row = explode('|', $row);
            $row = array_filter($row);
            $row = array_map('trim', $row);

            if (empty($headers)) {
                $headers = $row;
                continue;
            }

            $parsed[] = array_combine($headers, $row);
        }

        return $parsed;
    }
}
