<?php

use Illuminate\Console\Command;

class GenericCommand extends Command
{
    protected $signature = 'generic';

    public function getSomethingImportant()
    {
        return 'Important!';
    }

    public function handle()
    {
        $this->info('Hello, World!');
    }
}
