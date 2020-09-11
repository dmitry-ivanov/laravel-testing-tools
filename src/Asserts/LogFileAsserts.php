<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait LogFileAsserts
{
    /**
     * Assert that the given log file exists.
     *
     * The path is relative to the `storage/logs` folder.
     *
     * @param string $path
     * @return void
     */
    protected function seeLogFile(string $path)
    {
        $message = "Failed asserting that log file `{$path}` exists.";
        $this->assertFileExists($this->composeLogFilePath($path), $message);
    }

    /**
     * Assert that the given log file doesn't exist.
     *
     * The path is relative to the `storage/logs` folder.
     *
     * @param string $path
     * @return void
     */
    protected function dontSeeLogFile(string $path)
    {
        $message = "Failed asserting that log file `{$path}` not exists.";
        self::assertFileDoesNotExist($this->composeLogFilePath($path), $message);
    }

    /**
     * Assert that the log file contains the given message.
     *
     * The path is relative to the `storage/logs` folder.
     *
     * @param string $path
     * @param string|array $message
     * @return void
     */
    protected function seeInLogFile(string $path, $message)
    {
        $messages = !is_array($message) ? [$message] : $message;

        $content = File::get($this->composeLogFilePath($path));
        foreach ($messages as $item) {
            $pattern = $this->composeRegexPattern($item);
            self::assertMatchesRegularExpression($pattern, $content, "Failed asserting that file `{$path}` contains `{$item}`.");
        }
    }

    /**
     * Assert that the log file doesn't contain the given message.
     *
     * The path is relative to the `storage/logs` folder.
     *
     * @param string $path
     * @param string|array $message
     * @return void
     */
    protected function dontSeeInLogFile(string $path, $message)
    {
        $messages = !is_array($message) ? [$message] : $message;

        $content = File::get($this->composeLogFilePath($path));
        foreach ($messages as $item) {
            $pattern = $this->composeRegexPattern($item);
            self::assertDoesNotMatchRegularExpression($pattern, $content, "Failed asserting that file `{$path}` not contains `{$item}`.");
        }
    }

    /**
     * Compose the log file path.
     *
     * @param string $path
     * @return string
     */
    private function composeLogFilePath(string $path)
    {
        return storage_path("logs/{$path}");
    }

    /**
     * Compose regex pattern for the given log message.
     *
     * @param string $message
     * @return string
     */
    private function composeRegexPattern(string $message)
    {
        $pattern = '/'
            . preg_quote($message, '/')
            . (Str::startsWith($message, 'array:') ? '' : '\n')
            . '/';

        return str_replace('%datetime%', '\d{4}-\d{2}-\d{2} \d{2}\:\d{2}\:\d{2}', $pattern);
    }
}
