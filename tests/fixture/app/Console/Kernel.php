<?php

namespace Illuminated\TestingTools\Tests\Fixture\App\Console;

use Illuminated\TestingTools\Tests\Fixture\App\Console\Commands\GenericCommand;
use Illuminated\TestingTools\Tests\Fixture\App\Console\Commands\TableOutputCommand;
use Illuminated\TestingTools\Tests\Fixture\App\Console\Commands\ConfirmationCommand;
use Illuminated\TestingTools\Tests\Fixture\App\Console\Commands\ConfirmableTraitCommand;

class Kernel extends \Orchestra\Testbench\Console\Kernel
{
    protected $commands = [
        GenericCommand::class,
        TableOutputCommand::class,
        ConfirmationCommand::class,
        ConfirmableTraitCommand::class,
    ];
}
