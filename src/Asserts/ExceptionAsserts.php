<?php

namespace Illuminated\Testing\Asserts;

trait ExceptionAsserts
{
    protected function willSeeException($class, $message = null, $code = 0)
    {
        $this->expectException($class);

        if (!is_null($message)) {
            $this->expectExceptionMessage($message);
        }

        $this->expectExceptionCode($code);
    }
}
