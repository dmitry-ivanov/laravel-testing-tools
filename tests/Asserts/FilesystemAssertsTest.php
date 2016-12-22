<?php

class FilesystemAssertsTest extends TestCase
{
    /** @test */
    public function it_has_directory_empty_assertion()
    {
        $this->assertDirectoryEmpty(__DIR__ . '/FilesystemAssertsTest/Empty');
    }
}
