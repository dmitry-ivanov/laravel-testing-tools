<?php

namespace Illuminated\Testing\Tests\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class ConfirmableTraitCommand extends Command
{
    use ConfirmableTrait;

    protected $signature = 'confirmable {--force : Force to run without confirmation}';

    public function handle()
    {
        if (!$this->confirmToProceed('Attention, please!', true)) {
            return;
        }

        $this->info('Done!');
    }
}
