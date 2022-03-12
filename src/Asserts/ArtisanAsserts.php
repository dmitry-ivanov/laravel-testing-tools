<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mockery;

trait ArtisanAsserts
{
    /**
     * Add expectation that the given confirmation question would be shown.
     */
    protected function willSeeConfirmation(string $question, string $command, array $parameters = []): void
    {
        $mock = Mockery::mock("{$command}[confirm]");
        $mock->shouldReceive('confirm')->once()->with($question);

        $this->runArtisan($mock, $parameters);
    }

    /**
     * Add expectation that the given confirmation question would not be shown.
     */
    protected function willNotSeeConfirmation(string $question, string $command, array $parameters = []): void
    {
        $mock = Mockery::mock("{$command}[confirm]");
        $mock->shouldNotReceive('confirm')->with($question);

        $this->runArtisan($mock, $parameters);
    }

    /**
     * Add expectation that the given confirmation question would be shown, and accept it.
     */
    protected function willGiveConfirmation(string $question, string $command, array $parameters = []): void
    {
        $mock = Mockery::mock("{$command}[confirm]");
        $mock->shouldReceive('confirm')->once()->with($question)->andReturn(true);

        $this->runArtisan($mock, $parameters);
    }

    /**
     * Add expectation that the given confirmation question would be shown, and do not accept it.
     */
    protected function willNotGiveConfirmation(string $question, string $command, array $parameters = []): void
    {
        $mock = Mockery::mock("{$command}[confirm]");
        $mock->shouldReceive('confirm')->once()->with($question)->andReturn(false);

        $this->runArtisan($mock, $parameters);
    }

    /**
     * Assert that the given artisan output is seen.
     */
    protected function seeArtisanOutput(string $output): void
    {
        if (File::exists($output)) {
            $output = File::get($output);
        }

        $expected = trim($output);
        $actual = trim($this->getArtisanOutput());
        $this->assertEquals($expected, $actual, "Failed asserting that artisan output is `{$expected}`.");
    }

    /**
     * Assert that the given artisan output is not seen.
     */
    protected function dontSeeArtisanOutput(string $output): void
    {
        if (File::exists($output)) {
            $output = File::get($output);
        }

        $expected = trim($output);
        $actual = trim($this->getArtisanOutput());
        $this->assertNotEquals($expected, $actual, "Failed asserting that artisan output is not `{$expected}`.");
    }

    /**
     * Assert that the given string is seen in the artisan output.
     */
    protected function seeInArtisanOutput(string $needle): void
    {
        if (File::exists($needle)) {
            $needle = File::get($needle);
        }

        $output = $this->getArtisanOutput();
        $message = "Failed asserting that artisan output contains `{$needle}`.";
        $this->assertStringContainsString($needle, $output, $message);
    }

    /**
     * Assert that the given string is not seen in the artisan output.
     */
    protected function dontSeeInArtisanOutput(string $needle): void
    {
        if (File::exists($needle)) {
            $needle = File::get($needle);
        }

        $output = $this->getArtisanOutput();
        $message = "Failed asserting that artisan output not contains `{$needle}`.";
        $this->assertStringNotContainsString($needle, $output, $message);
    }

    /**
     * Assert that the given data is seen in the artisan table output.
     */
    protected function seeArtisanTableOutput(array $data): void
    {
        $message = 'Failed asserting that artisan table output consists of expected data.';
        $this->assertEquals($data, $this->parseArtisanTableOutput($this->getArtisanOutput()), $message);
    }

    /**
     * Assert that the given data is not seen in the artisan table output.
     */
    protected function dontSeeArtisanTableOutput(array $data): void
    {
        $message = 'Failed asserting that artisan table output not consists of expected data.';
        $this->assertNotEquals($data, $this->parseArtisanTableOutput($this->getArtisanOutput()), $message);
    }

    /**
     * Assert that the artisan table output has the given number of data rows.
     */
    protected function seeArtisanTableRowsCount(int $count): void
    {
        $message = "Failed asserting that artisan table rows count equals to `{$count}`.";
        $this->assertCount($count, $this->parseArtisanTableOutput($this->getArtisanOutput()), $message);
    }

    /**
     * Assert that the artisan table output doesn't have the given number of data rows.
     */
    protected function dontSeeArtisanTableRowsCount(int $count): void
    {
        $message = "Failed asserting that artisan table rows count not equals to `{$count}`.";
        $this->assertNotCount($count, $this->parseArtisanTableOutput($this->getArtisanOutput()), $message);
    }

    /**
     * Parse the artisan table output.
     *
     * Return data rows with headers as keys.
     */
    private function parseArtisanTableOutput(string $output): array
    {
        $output = explode("\n", trim($output));

        // Filter and normalize the output
        $output = collect($output)
            ->reject(function (string $line) {
                return !Str::contains($line, '|');
            })
            ->map(function (string $line) {
                $line = explode('|', $line);
                $line = array_filter($line);
                return array_map('trim', $line);
            });

        // The first item is headers
        $headers = $output->shift();

        // Combine headers with the line values
        return $output->map(function (array $values) use ($headers) {
            return array_combine($headers, $values);
        })->toArray();
    }
}
