<?php

namespace Illuminated\Testing\Tests\Asserts;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminated\Testing\Tests\TestCase;

class LogFileAssertsTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->createSampleLogFile();
    }

    /**
     * Create a sample log file.
     */
    private function createSampleLogFile(): void
    {
        $date = Carbon::now();
        $path = storage_path('logs/example.log');

        File::put($path, "[{$date}]: Sample log message 1!\n");
        File::append($path, "[{$date}]: Sample log message 2!\n");
        File::append($path, "[{$date}]: Sample log message 3!\n");
    }

    /** @test */
    public function it_has_see_log_file_assertion()
    {
        $this->seeLogFile('example.log');
    }

    /** @test */
    public function it_has_dont_see_log_file_assertion()
    {
        $this->dontSeeLogFile('fake.log');
    }

    /** @test */
    public function it_has_see_in_log_file_assertion()
    {
        $this->seeInLogFile('example.log', 'Sample log message 1!');
        $this->seeInLogFile('example.log', 'Sample log message 2!');
        $this->seeInLogFile('example.log', 'Sample log message 3!');
    }

    /** @test */
    public function which_supports_array_of_contents()
    {
        $this->seeInLogFile('example.log', [
            'Sample log message 1!',
            'Sample log message 2!',
            'Sample log message 3!',
        ]);
    }

    /** @test */
    public function which_supports_datetime_placeholder()
    {
        $this->seeInLogFile('example.log', '[%datetime%]: Sample log message 1!');
        $this->seeInLogFile('example.log', '[%datetime%]: Sample log message 2!');
        $this->seeInLogFile('example.log', '[%datetime%]: Sample log message 3!');
    }

    /** @test */
    public function it_has_dont_see_in_log_file_assertion()
    {
        $this->dontSeeInLogFile('example.log', 'Not existing log message 1!');
        $this->dontSeeInLogFile('example.log', 'Not existing log message 2!');
        $this->dontSeeInLogFile('example.log', 'Not existing log message 3!');
    }

    /** @test */
    public function which_also_supports_array_of_contents()
    {
        $this->dontSeeInLogFile('example.log', [
            'Not existing log message 1!',
            'Not existing log message 2!',
            'Not existing log message 3!',
        ]);
    }

    /**
     * Clean up the testing environment before the next test.
     */
    protected function tearDown(): void
    {
        File::delete(storage_path('logs/example.log'));

        parent::tearDown();
    }
}
