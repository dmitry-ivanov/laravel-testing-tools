<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminated\Testing\Asserts\LogFileAsserts;

class LogFileAssertsTest extends TestCase
{
    use LogFileAsserts;

    protected function setUp()
    {
        parent::setUp();

        $this->createSampleLogFile();
    }

    private function createSampleLogFile()
    {
        $date = Carbon::now();
        $path = storage_path('logs/example.log');

        File::put($path, "[{$date}]: Sample log message 1!\n");
        File::append($path, "[{$date}]: Sample log message 2!\n");
        File::append($path, "[{$date}]: Sample log message 3!\n");
    }

    /** @test */
    public function it_has_log_file_exists_assertion()
    {
        $this->assertLogFileExists('example.log');
    }

    /** @test */
    public function it_has_log_file_not_exists_assertion()
    {
        $this->assertLogFileNotExists('foobar.log');
    }

    /** @test */
    public function it_has_log_file_contains_assertion()
    {
        $this->assertLogFileContains('example.log', 'Sample log message 1!');
        $this->assertLogFileContains('example.log', 'Sample log message 2!');
        $this->assertLogFileContains('example.log', 'Sample log message 3!');
    }

    /** @test */
    public function it_has_log_file_not_contains_assertion()
    {
        $this->assertLogFileNotContains('example.log', 'Sample log message 111!');
        $this->assertLogFileNotContains('example.log', 'Sample log message 222!');
        $this->assertLogFileNotContains('example.log', 'Sample log message 333!');
    }

    /** @test */
    public function log_file_contains_assertion_supports_datetime_placeholder()
    {
        $this->assertLogFileContains('example.log', '[%datetime%]: Sample log message 1!');
        $this->assertLogFileContains('example.log', '[%datetime%]: Sample log message 2!');
        $this->assertLogFileContains('example.log', '[%datetime%]: Sample log message 3!');
    }

    protected function tearDown()
    {
        File::delete(storage_path('logs/example.log'));

        parent::tearDown();
    }
}
