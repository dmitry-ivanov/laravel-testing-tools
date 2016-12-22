<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait FilesystemAsserts
{
    protected function assertDirectoryEmpty($path)
    {
        $glob = Str::finish($path, '/') . '*';
        $this->assertEmpty(File::glob($glob), "Failed asserting that `{$path}` directory is empty.");
    }

    protected function assertDirectoryNotEmpty($path)
    {
        $glob = Str::finish($path, '/') . '*';
        $this->assertNotEmpty(File::glob($glob), "Failed asserting that `{$path}` directory is not empty.");
    }
}
