<?php

namespace Illuminated\Testing\Asserts;

trait PageAsserts
{
    protected function seeElementTimes($selector, $times)
    {
        $message = "Failed asserting that the page contains the element [{$selector}] {$times} times.";
        $this->assertCount($times, $this->crawler->filter($selector), $message);

        return $this;
    }

    protected function dontSeeElementTimes($selector, $times)
    {
        $message = "Failed asserting that the page not contains the element [{$selector}] {$times} times.";
        $this->assertNotCount($times, $this->crawler->filter($selector), $message);

        return $this;
    }
}
