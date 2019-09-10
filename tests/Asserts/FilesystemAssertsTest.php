<?php

namespace Illuminated\TestingTools\Tests\Asserts;

use Illuminated\TestingTools\Tests\TestCase;

class FilesystemAssertsTest extends TestCase
{
    /** @test */
    public function it_has_directory_empty_assertion()
    {
        $this->assertDirectoryEmpty(__DIR__ . '/FilesystemAssertsTest/Empty');
    }

    /** @test */
    public function it_has_directory_not_empty_assertion()
    {
        $this->assertDirectoryNotEmpty(__DIR__ . '/FilesystemAssertsTest/NotEmpty');
        $this->assertDirectoryNotEmpty(__DIR__ . '/FilesystemAssertsTest/WithSubDirectory');
    }

    /** @test */
    public function it_has_files_count_assertion()
    {
        $this->assertFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 3);
        $this->assertFilesCount(__DIR__ . '/FilesystemAssertsTest/WithSubDirectory', 0);
    }

    /** @test */
    public function it_has_not_files_count_assertion()
    {
        $this->assertNotFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 1);
        $this->assertNotFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 2);
        $this->assertNotFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 4);
        $this->assertNotFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 5);
    }
}
