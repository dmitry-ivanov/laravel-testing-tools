<?php

namespace Illuminated\Testing\Tests\App\Console\Commands;

use Illuminate\Console\Command;

class GenericCommand extends Command
{
    protected $signature = 'generic {--name= : Name for greeting message}';

    public function getGreetingMessage()
    {
        $name = $this->option('name') ?: 'Dude';
        return "Hello, {$name}!";
    }

    public function handle()
    {
        $this->info('Hello, World!');
    }
}
