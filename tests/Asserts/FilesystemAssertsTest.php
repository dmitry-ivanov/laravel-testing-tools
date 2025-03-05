<?php

namespace Illuminated\Testing\Tests\Asserts;

use Illuminated\Testing\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class FilesystemAssertsTest extends TestCase
{
    #[Test]
    public function it_has_directory_empty_assertion(): void
    {
        $this->assertDirectoryEmpty(__DIR__ . '/FilesystemAssertsTest/Empty');
    }

    #[Test]
    public function it_has_directory_not_empty_assertion(): void
    {
        $this->assertDirectoryNotEmpty(__DIR__ . '/FilesystemAssertsTest/NotEmpty');
        $this->assertDirectoryNotEmpty(__DIR__ . '/FilesystemAssertsTest/WithSubDirectory');
    }

    #[Test]
    public function it_has_files_count_assertion(): void
    {
        $this->assertFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 3);
        $this->assertFilesCount(__DIR__ . '/FilesystemAssertsTest/WithSubDirectory', 0);
    }

    #[Test]
    public function it_has_not_files_count_assertion(): void
    {
        $this->assertNotFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 1);
        $this->assertNotFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 2);
        $this->assertNotFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 4);
        $this->assertNotFilesCount(__DIR__ . '/FilesystemAssertsTest/NotEmpty', 5);
    }
}
