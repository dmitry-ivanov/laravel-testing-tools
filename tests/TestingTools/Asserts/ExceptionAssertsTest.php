<?php

namespace Illuminated\Testing\TestingTools\Tests\Asserts;

use Illuminated\Testing\TestingTools\Tests\TestCase;
use RuntimeException;

class ExceptionAssertsTest extends TestCase
{
    /** @test */
    public function it_has_will_see_exception_assertion()
    {
        $this->willSeeException(RuntimeException::class, 'Oops! Houston, we have a problem!');

        throw new RuntimeException('Oops! Houston, we have a problem!');
    }
}
