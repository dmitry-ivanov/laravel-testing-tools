<?php

namespace Illuminated\Testing\Asserts;

trait ExceptionAsserts
{
    /**
     * Add expectation that the given exception would be thrown.
     */
    protected function willSeeException(string $class, string $message = '', int $code = 0): void
    {
        $this->expectException($class);

        if ($message) {
            $this->expectExceptionMessage($message);
        }

        $this->expectExceptionCode($code);
    }
}
