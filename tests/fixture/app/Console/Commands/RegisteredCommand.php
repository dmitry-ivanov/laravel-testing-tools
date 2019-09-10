<?php

namespace Illuminated\TestingTools\Tests\Fixture\App\Console\Commands;

use Illuminate\Console\Command;

class RegisteredCommand extends Command
{
    protected $signature = 'registered';

    public function handle()
    {
        $this->info('Done!');
    }
}
