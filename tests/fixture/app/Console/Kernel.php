<?php

namespace Illuminated\Testing\Tests\App\Console;

use Illuminated\Testing\Tests\App\Console\Commands\GenericCommand;
use Illuminated\Testing\Tests\App\Console\Commands\TableOutputCommand;
use Illuminated\Testing\Tests\App\Console\Commands\ConfirmationCommand;
use Illuminated\Testing\Tests\App\Console\Commands\ConfirmableTraitCommand;

class Kernel extends \Orchestra\Testbench\Console\Kernel
{
    protected $commands = [
        GenericCommand::class,
        TableOutputCommand::class,
        ConfirmationCommand::class,
        ConfirmableTraitCommand::class,
    ];
}
