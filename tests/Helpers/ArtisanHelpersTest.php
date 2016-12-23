<?php

class ArtisanHelpersTest extends TestCase
{
    /** @test */
    public function it_can_run_artisan_command_by_class_name()
    {
        $command = $this->runArtisan(GenericCommand::class);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, Dude!', $command->getGreetingMessage());
    }

    /** @test */
    public function it_can_run_artisan_command_by_class_name_and_parameters()
    {
        $command = $this->runArtisan(GenericCommand::class, ['--name' => 'John']);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, John!', $command->getGreetingMessage());
    }

    /** @test */
    public function it_can_run_artisan_command_by_object()
    {
        $command = $this->runArtisan(new GenericCommand);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, Dude!', $command->getGreetingMessage());
    }

    /** @test */
    public function it_can_run_artisan_command_by_object_and_parameters()
    {
        $command = $this->runArtisan(new GenericCommand, ['--name' => 'Jane']);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, Jane!', $command->getGreetingMessage());
    }
}
