<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\File;

trait FilesystemAsserts
{
    protected function assertDirectoryEmpty($path)
    {
        $this->assertEmpty(File::glob($path), "Failed asserting that `{$path}` directory is empty.");
    }

    protected function assertDirectoryNotEmpty($path)
    {
        $this->assertNotEmpty(File::glob($path), "Failed asserting that `{$path}` directory is not empty.");
    }
}
