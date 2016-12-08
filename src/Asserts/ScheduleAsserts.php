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

    // protected function assertCommandIsScheduledToRun($command, $expression)
    // {
    //     $this->guardCommandIsScheduled($command, $expression, false);
    // }
    //
    // protected function assertCommandIsScheduledToRunInBackground($command, $expression)
    // {
    //     $this->guardCommandIsScheduled($command, $expression, true);
    // }
    //
    // private function guardCommandIsScheduled($command, $expression, $runInBackground)
    // {
    //     $event = $this->getScheduledCommandEvent($command);
    //
    //     $message = "Command `{$command}` is not scheduled.";
    //     $this->assertNotEmpty($event, $message);
    //     $this->assertInstanceOf(Event::class, $event, $message);
    //
    //     $message = "Command `{$command}` is scheduled in unexpected way.";
    //     $this->assertEquals($expression, $event->expression, $message);
    //     $this->assertEquals($runInBackground, $event->runInBackground, $message);
    // }
    //
    // private function getScheduledCommandEvent($command)
    // {
    //     $schedule = app(Schedule::class);
    //
    //     $events = $schedule->events();
    //     foreach ($events as $event) {
    //         if (ends_with($event->command, $command)) {
    //             return $event;
    //         }
    //     }
    //
    //     return false;
    // }
}
