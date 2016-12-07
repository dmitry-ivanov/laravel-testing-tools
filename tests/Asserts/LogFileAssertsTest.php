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
        $path = storage_path('logs/sample.log');

        File::put($path, "[{$date}]: Sample log message 1!\n");
        File::append($path, "[{$date}]: Sample log message 2!\n");
        File::append($path, "[{$date}]: Sample log message 3!\n");
    }

    /** @test */
    public function it_has_log_file_exists_assertion()
    {
        $this->assertLogFileExists('sample.log');
    }

    protected function tearDown()
    {
        File::delete(storage_path('logs/sample.log'));

        parent::tearDown();
    }
}
