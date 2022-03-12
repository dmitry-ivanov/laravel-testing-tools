<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait FilesystemAsserts
{
    /**
     * Assert that the given directory is empty.
     */
    protected function assertDirectoryEmpty(string $path): void
    {
        $glob = Str::finish($path, '/') . '*';
        $this->assertEmpty(File::glob($glob), "Failed asserting that directory `{$path}` is empty.");
    }

    /**
     * Assert that the given directory is not empty.
     */
    protected function assertDirectoryNotEmpty(string $path): void
    {
        $glob = Str::finish($path, '/') . '*';
        $this->assertNotEmpty(File::glob($glob), "Failed asserting that directory `{$path}` is not empty.");
    }

    /**
     * Assert that directory has the given number of files.
     */
    protected function assertFilesCount(string $path, int $count): void
    {
        $message = "Failed asserting that directory `{$path}` has `{$count}` files.";
        $this->assertCount($count, File::files($path), $message);
    }

    /**
     * Assert that directory doesn't have the given number of files.
     */
    protected function assertNotFilesCount(string $path, int $count): void
    {
        $message = "Failed asserting that directory `{$path}` not has `{$count}` files.";
        $this->assertNotCount($count, File::files($path), $message);
    }
}
