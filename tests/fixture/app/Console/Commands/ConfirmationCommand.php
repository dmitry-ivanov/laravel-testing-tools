<?php

namespace Illuminated\Testing\Tests\App\Console\Commands;

use Illuminate\Console\Command;

class ConfirmationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirmation';

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        if (!$this->confirm('Are you sure?')) {
            return;
        }

        $this->info('Done!');
    }
}
