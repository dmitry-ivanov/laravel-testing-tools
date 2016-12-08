<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Console\Scheduling\Schedule;

trait ScheduleAsserts
{
    protected function assertScheduleCount($count)
    {
        $message = "Failed asserting that schedule events count is {$count}.";
        $this->assertCount($count, app(Schedule::class)->events(), $message);
    }

    protected function assertNotScheduleCount($count)
    {
        $message = "Failed asserting that schedule events count is not {$count}.";
        $this->assertNotCount($count, app(Schedule::class)->events(), $message);
    }
}
