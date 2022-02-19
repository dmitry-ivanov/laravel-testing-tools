<?php

namespace Illuminated\Testing\Tests\App\Console;

use Illuminated\Testing\Tests\App\Console\Commands\ConfirmableTraitCommand;
use Illuminated\Testing\Tests\App\Console\Commands\ConfirmationCommand;
use Illuminated\Testing\Tests\App\Console\Commands\GenericCommand;
use Illuminated\Testing\Tests\App\Console\Commands\TableOutputCommand;

class Kernel extends \Orchestra\Testbench\Foundation\Console\Kernel
{
    /**
     * The Artisan commands provided by the application.
     *
     * @var array
     */
    protected $commands = [
        GenericCommand::class,
        TableOutputCommand::class,
        ConfirmationCommand::class,
        ConfirmableTraitCommand::class,
    ];
}
