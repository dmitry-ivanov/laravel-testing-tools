<?php

namespace Illuminated\Testing\Tests\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class ConfirmableTraitCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirmable {--force : Force to run without confirmation}';

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        if (!$this->confirmToProceed('Attention, please!', true)) {
            return;
        }

        $this->info('Done!');
    }
}
