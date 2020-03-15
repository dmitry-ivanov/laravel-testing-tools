<?php

namespace Illuminated\Testing\Tests\App\Console\Commands;

use Illuminate\Console\Command;

class GenericCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generic {--name= : Name for greeting message}';

    /**
     * Handle the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Hello, World!');
    }

    /**
     * Get the greeting message.
     *
     * @return string
     */
    public function getGreetingMessage()
    {
        $name = $this->option('name') ?: 'Dude';

        return "Hello, {$name}!";
    }
}
