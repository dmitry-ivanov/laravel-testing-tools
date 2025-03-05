<?php

namespace Illuminated\Testing\Tests\Asserts;

use Illuminate\Console\Scheduling\Schedule;
use Illuminated\Testing\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ScheduleAssertsTest extends TestCase
{
    /**
     * Resolve application Console Kernel implementation.
     */
    protected function resolveApplicationConsoleKernel($app): void
    {
        parent::resolveApplicationConsoleKernel($app);

        $this->createSampleSchedule();
    }

    /**
     * Create a sample schedule.
     */
    private function createSampleSchedule(): void
    {
        app()->booted(function () {
            $schedule = app(Schedule::class);

            $schedule->command('foo')->everyFiveMinutes();
            $schedule->command('bar')->hourly();
            $schedule->command('baz')->twiceDaily()->runInBackground();
        });
    }

    #[Test]
    public function it_has_see_schedule_count_assertion(): void
    {
        $this->seeScheduleCount(3);
    }

    #[Test]
    public function it_has_dont_see_schedule_count_assertion(): void
    {
        $this->dontSeeScheduleCount(1);
        $this->dontSeeScheduleCount(2);
        $this->dontSeeScheduleCount(4);
        $this->dontSeeScheduleCount(5);
    }

    #[Test]
    public function it_has_see_in_schedule_assertion(): void
    {
        $this->seeInSchedule('foo', '*/5 * * * *');
        $this->seeInSchedule('bar', '0 * * * *');
        $this->seeInSchedule('baz', '0 1,13 * * *', true);
    }

    #[Test]
    public function which_allows_expressions_same_as_schedule_methods(): void
    {
        $this->seeInSchedule('foo', 'everyFiveMinutes');
        $this->seeInSchedule('bar', 'hourly');
        $this->seeInSchedule('baz', 'twiceDaily', true);
    }

    #[Test]
    public function it_has_dont_see_in_schedule_assertion(): void
    {
        $this->dontSeeInSchedule('fake');
    }
}
