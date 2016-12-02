<?php

namespace Illuminated\Testing\Asserts;

trait PageAsserts
{
    protected function seeElementTimes($selector, $times)
    {
        $this->assertCount($times, $this->crawler->filter($selector));
        return $this;
    }
}
