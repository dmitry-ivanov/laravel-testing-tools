<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait FilesystemAsserts
{
    protected function assertDirectoryEmpty($path)
    {
        $glob = Str::finish($path, '/') . '*';
        $this->assertEmpty(File::glob($glob), "Failed asserting that directory `{$path}` is empty.");
    }

    protected function assertDirectoryNotEmpty($path)
    {
        $glob = Str::finish($path, '/') . '*';
        $this->assertNotEmpty(File::glob($glob), "Failed asserting that directory `{$path}` is not empty.");
    }

    protected function assertFilesCount($path, $count)
    {
        $message = "Failed asserting that directory `{$path}` has `{$count}` files.";
        $this->assertCount($count, File::files($path), $message);
    }

    protected function assertNotFilesCount($path, $count)
    {
        $message = "Failed asserting that directory `{$path}` not has `{$count}` files.";
        $this->assertNotCount($count, File::files($path), $message);
    }
}
