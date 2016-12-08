<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel;
use Illuminated\Testing\Asserts\ScheduleAsserts;

class ScheduleAssertsTest extends TestCase
{
    use ScheduleAsserts;

    protected function resolveApplicationConsoleKernel($app)
    {
        parent::resolveApplicationConsoleKernel($app);

        app(Kernel::class);

        $this->createSampleSchedule();
    }

    private function createSampleSchedule()
    {
        app()->booted(function () {
            $schedule = app(Schedule::class);

            $schedule->command('foo')->everyMinute();
            $schedule->command('bar')->everyMinute();
            $schedule->command('baz')->everyMinute();
        });
    }

    /** @test */
    public function it_has_schedule_count_assertion()
    {
        $this->assertScheduleCount(3);
    }

    /** @test */
    public function it_has_not_schedule_count_assertion()
    {
        $this->assertNotScheduleCount(1);
        $this->assertNotScheduleCount(2);
        $this->assertNotScheduleCount(4);
        $this->assertNotScheduleCount(5);
    }
}
