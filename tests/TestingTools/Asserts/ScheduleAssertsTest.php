<?php

namespace Illuminated\Testing\TestingTools\Tests\Asserts;

use Illuminate\Console\Scheduling\Schedule;
use Illuminated\Testing\TestingTools\Tests\TestCase;

class ScheduleAssertsTest extends TestCase
{
    protected function resolveApplicationConsoleKernel($app)
    {
        parent::resolveApplicationConsoleKernel($app);

        $this->createSampleSchedule();
    }

    private function createSampleSchedule()
    {
        app()->booted(function () {
            $schedule = app(Schedule::class);

            $schedule->command('foo')->everyFiveMinutes();
            $schedule->command('bar')->hourly();

            $schedule->command('baz')->twiceDaily();
        });
    }

    /** @test */
    public function it_has_see_schedule_count_assertion()
    {
        $this->seeScheduleCount(3);
    }

    /** @test */
    public function it_has_dont_see_schedule_count_assertion()
    {
        $this->dontSeeScheduleCount(1);
        $this->dontSeeScheduleCount(2);
        $this->dontSeeScheduleCount(4);
        $this->dontSeeScheduleCount(5);
    }

    /** @test */
    public function it_has_see_in_schedule_assertion()
    {
        $this->seeInSchedule('foo', '*/5 * * * * *');
        $this->seeInSchedule('bar', '0 * * * * *');
        $this->seeInSchedule('baz', '0 1,13 * * * *', true);
    }

    /** @test */
    public function which_allows_expressions_same_as_schedule_methods()
    {
        $this->seeInSchedule('foo', 'everyFiveMinutes');
        $this->seeInSchedule('bar', 'hourly');
        $this->seeInSchedule('baz', 'twiceDaily', true);
    }

    /** @test */
    public function it_has_dont_see_in_schedule_assertion()
    {
        $this->dontSeeInSchedule('foobarbaz');
    }
}
