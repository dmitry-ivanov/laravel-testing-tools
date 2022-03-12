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
     */
    public function handle(): void
    {
        $this->info('Hello, World!');
    }

    /**
     * Get the greeting message.
     */
    public function getGreetingMessage(): string
    {
        $name = $this->option('name') ?: 'Dude';

        return "Hello, {$name}!";
    }
}
