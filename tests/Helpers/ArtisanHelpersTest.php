<?php

namespace Illuminated\Testing\Tests\Helpers;

use Illuminated\Testing\Tests\App\Console\Commands\GenericCommand;
use Illuminated\Testing\Tests\TestCase;

class ArtisanHelpersTest extends TestCase
{
    /** @test */
    public function it_can_run_artisan_command_by_class_name()
    {
        /** @var GenericCommand $command */
        $command = $this->runArtisan(GenericCommand::class);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, Dude!', $command->getGreetingMessage());
    }

    /** @test */
    public function it_can_run_artisan_command_by_class_name_and_parameters()
    {
        /** @var GenericCommand $command */
        $command = $this->runArtisan(GenericCommand::class, ['--name' => 'John']);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, John!', $command->getGreetingMessage());
    }

    /** @test */
    public function it_can_run_artisan_command_by_object()
    {
        /** @var GenericCommand $command */
        $command = $this->runArtisan(new GenericCommand);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, Dude!', $command->getGreetingMessage());
    }

    /** @test */
    public function it_can_run_artisan_command_by_object_and_parameters()
    {
        /** @var GenericCommand $command */
        $command = $this->runArtisan(new GenericCommand, ['--name' => 'Jane']);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, Jane!', $command->getGreetingMessage());
    }
}
