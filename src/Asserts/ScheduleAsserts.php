<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Str;

trait ScheduleAsserts
{
    /**
     * Assert that schedule count equals to the given value.
     */
    protected function seeScheduleCount(int $count): void
    {
        $message = "Failed asserting that schedule events count is {$count}.";
        $this->assertCount($count, app(Schedule::class)->events(), $message);
    }

    /**
     * Assert that schedule count doesn't equal to the given value.
     */
    protected function dontSeeScheduleCount(int $count): void
    {
        $message = "Failed asserting that schedule events count is not {$count}.";
        $this->assertNotCount($count, app(Schedule::class)->events(), $message);
    }

    /**
     * Assert that the given command is scheduled.
     */
    protected function seeInSchedule(string $command, string $expression, bool $runInBackground = false): void
    {
        $event = $this->getScheduleEvent($command);

        $message = "Failed asserting that command `{$command}` is in schedule.";
        $this->assertNotEmpty($event, $message);
        $this->assertInstanceOf(Event::class, $event, $message);

        $message = "Failed asserting that command `{$command}` is in schedule as `{$expression}`.";
        $expression = $this->normalizeScheduleExpression(clone $event, $expression);
        $this->assertEquals($expression, $event->expression, $message);

        $message = "Failed asserting that command `{$command}` is scheduled with the same `run in background` mode.";
        $this->assertEquals($runInBackground, $event->runInBackground, $message);
    }

    /**
     * Assert that the given command is not scheduled.
     */
    protected function dontSeeInSchedule(string $command): void
    {
        $message = "Failed asserting that command `{$command}` is not in schedule.";
        $this->assertEmpty($this->getScheduleEvent($command), $message);
    }

    /**
     * Get schedule event by the given command.
     */
    private function getScheduleEvent(string $command): Event|null
    {
        $schedule = app(Schedule::class);

        return collect($schedule->events())
            ->first(function (Event $event) use ($command) {
                return Str::endsWith($event->command, $command);
            });
    }

    /**
     * Normalize the given schedule expression.
     */
    private function normalizeScheduleExpression(Event $event, string $expression): string
    {
        if (method_exists($event, $expression)) {
            $event->$expression();
            return $event->getExpression();
        }

        return $expression;
    }
}
