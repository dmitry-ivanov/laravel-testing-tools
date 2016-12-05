<?php

use Illuminated\Testing\Asserts\PageAsserts;

class PageAssertsTest extends TestCase
{
    use PageAsserts;

    /** @test */
    public function it_has_see_element_times_assertion()
    {
        $this->visit('/');
        $this->seeElementTimes('.body-item', 3);
    }
}
