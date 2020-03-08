<?php

namespace Illuminated\Testing\Asserts;

trait ExceptionAsserts
{
    /**
     * Add expectation that the given exception would be thrown.
     *
     * @param string $class
     * @param string $message
     * @param int $code
     * @return void
     */
    protected function willSeeException(string $class, string $message = '', int $code = 0)
    {
        $this->expectException($class);

        if ($message) {
            $this->expectExceptionMessage($message);
        }

        $this->expectExceptionCode($code);
    }
}
