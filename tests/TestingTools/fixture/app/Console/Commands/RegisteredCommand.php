<?php

use Illuminate\Console\Command;

class RegisteredCommand extends Command
{
    protected $signature = 'registered';

    public function handle()
    {
        $this->info('Done!');
    }
}
