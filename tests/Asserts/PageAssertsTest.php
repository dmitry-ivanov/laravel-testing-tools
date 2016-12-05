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

    /** @test */
    public function it_has_dont_see_element_times_assertion()
    {
        $this->visit('/');
        $this->dontSeeElementTimes('.body-item', 1);
        $this->dontSeeElementTimes('.body-item', 2);
        $this->dontSeeElementTimes('.body-item', 4);
        $this->dontSeeElementTimes('.body-item', 5);
    }
}
