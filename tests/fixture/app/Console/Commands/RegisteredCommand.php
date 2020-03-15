<?php

namespace Illuminated\Testing\Tests\App\Console\Commands;

use Illuminate\Console\Command;

class RegisteredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered';

    /**
     * Handle the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Done!');
    }
}
