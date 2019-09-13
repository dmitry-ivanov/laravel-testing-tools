<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait LogFileAsserts
{
    protected function seeLogFile($path)
    {
        $message = "Failed asserting that log file `{$path}` exists.";
        $this->assertFileExists($this->composeLogFilePath($path), $message);
    }

    protected function dontSeeLogFile($path)
    {
        $message = "Failed asserting that log file `{$path}` not exists.";
        $this->assertFileNotExists($this->composeLogFilePath($path), $message);
    }

    protected function seeInLogFile($path, $expected)
    {
        $content = File::get($this->composeLogFilePath($path));
        $expected = !is_array($expected) ? [$expected] : $expected;

        foreach ($expected as $item) {
            $pattern = $this->normalizeExpectedLogFileContent($item);
            $this->assertRegExp($pattern, $content, "Failed asserting that file `{$path}` contains `{$item}`.");
        }
    }

    protected function dontSeeInLogFile($path, $expected)
    {
        $content = File::get($this->composeLogFilePath($path));
        $expected = !is_array($expected) ? [$expected] : $expected;

        foreach ($expected as $item) {
            $pattern = $this->normalizeExpectedLogFileContent($item);
            $this->assertNotRegExp($pattern, $content, "Failed asserting that file `{$path}` not contains `{$item}`.");
        }
    }

    private function composeLogFilePath($path)
    {
        return storage_path("logs/{$path}");
    }

    private function normalizeExpectedLogFileContent($content)
    {
        $content = '/' . preg_quote($content, '/') . (Str::startsWith($content, 'array:') ? '' : '\n') . '/';
        $content = str_replace('%datetime%', '\d{4}-\d{2}-\d{2} \d{2}\:\d{2}\:\d{2}', $content);

        return $content;
    }
}
