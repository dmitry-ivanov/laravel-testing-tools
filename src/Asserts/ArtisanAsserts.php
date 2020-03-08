<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mockery;

trait ArtisanAsserts
{
    /**
     * Add expectation that the given confirmation question would be shown.
     *
     * @param string $question
     * @param string $command
     * @param array $parameters
     * @return void
     */
    protected function willSeeConfirmation(string $question, string $command, array $parameters = [])
    {
        $mock = Mockery::mock("{$command}[confirm]");
        $mock->shouldReceive('confirm')->once()->with($question);

        $this->runArtisan($mock, $parameters);
    }

    /**
     * Add expectation that the given confirmation question would not be shown.
     *
     * @param string $question
     * @param string $command
     * @param array $parameters
     * @return void
     */
    protected function willNotSeeConfirmation(string $question, string $command, array $parameters = [])
    {
        $mock = Mockery::mock("{$command}[confirm]");
        $mock->shouldNotReceive('confirm')->with($question);

        $this->runArtisan($mock, $parameters);
    }

    /**
     * Add expectation that the given confirmation question would be shown, and accept it.
     *
     * @param string $question
     * @param string $command
     * @param array $parameters
     * @return void
     */
    protected function willGiveConfirmation(string $question, string $command, array $parameters = [])
    {
        $mock = Mockery::mock("{$command}[confirm]");
        $mock->shouldReceive('confirm')->once()->with($question)->andReturn(true);

        $this->runArtisan($mock, $parameters);
    }

    /**
     * Add expectation that the given confirmation question would be shown, and do not accept it.
     *
     * @param string $question
     * @param string $command
     * @param array $parameters
     * @return void
     */
    protected function willNotGiveConfirmation(string $question, string $command, array $parameters = [])
    {
        $mock = Mockery::mock("{$command}[confirm]");
        $mock->shouldReceive('confirm')->once()->with($question)->andReturn(false);

        $this->runArtisan($mock, $parameters);
    }

    /**
     * Assert that the given artisan output is seen.
     *
     * @param string $output
     * @return void
     */
    protected function seeArtisanOutput(string $output)
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
     *
     * @param string $output
     * @return void
     */
    protected function dontSeeArtisanOutput(string $output)
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
     *
     * @param string $needle
     * @return void
     */
    protected function seeInArtisanOutput(string $needle)
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
     *
     * @param string $needle
     * @return void
     */
    protected function dontSeeInArtisanOutput(string $needle)
    {
        if (File::exists($needle)) {
            $needle = File::get($needle);
        }

        $output = $this->getArtisanOutput();
        $message = "Failed asserting that artisan output not contains `{$needle}`.";
        $this->assertStringNotContainsString($needle, $output, $message);
    }

    /**
     * Assert that the given data is seen in the artisan output table.
     *
     * @param array $data
     * @return void
     */
    protected function seeArtisanTableOutput(array $data)
    {
        $message = 'Failed asserting that artisan table output consists of expected data.';
        $this->assertEquals($data, $this->parseArtisanTableOutput($this->getArtisanOutput()), $message);
    }

    /**
     * Assert that the given data is not seen in the artisan output table.
     *
     * @param array $data
     * @return void
     */
    protected function dontSeeArtisanTableOutput(array $data)
    {
        $message = 'Failed asserting that artisan table output not consists of expected data.';
        $this->assertNotEquals($data, $this->parseArtisanTableOutput($this->getArtisanOutput()), $message);
    }

    /**
     * Assert that the artisan output table has the given number of data rows.
     *
     * @param int $count
     * @return void
     */
    protected function seeArtisanTableRowsCount(int $count)
    {
        $message = "Failed asserting that artisan table rows count equals to `{$count}`.";
        $this->assertCount($count, $this->parseArtisanTableOutput($this->getArtisanOutput()), $message);
    }

    /**
     * Assert that the artisan output table doesn't have the given number of data rows.
     *
     * @param int $count
     * @return void
     */
    protected function dontSeeArtisanTableRowsCount(int $count)
    {
        $message = "Failed asserting that artisan table rows count not equals to `{$count}`.";
        $this->assertNotCount($count, $this->parseArtisanTableOutput($this->getArtisanOutput()), $message);
    }

    /**
     * Parse the artisan table output.
     *
     * Return data rows with headers as keys.
     *
     * @param string $output
     * @return array
     */
    private function parseArtisanTableOutput(string $output)
    {
        $output = explode("\n", trim($output));

        // Filter and normalize the output
        $output = collect($output)
            ->reject(function (string $line) {
                return ! Str::contains($line, '|');
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
