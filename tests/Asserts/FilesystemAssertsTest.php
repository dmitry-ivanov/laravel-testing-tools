<?php

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
}
