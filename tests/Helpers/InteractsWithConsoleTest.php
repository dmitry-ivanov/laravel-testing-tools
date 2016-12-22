<?php

class InteractsWithConsoleTest extends TestCase
{
    /** @test */
    public function it_can_run_console_command_by_class_name_and_optional_parameters()
    {
        $command = $this->runConsoleCommand(GenericCommand::class, ['--name' => 'John']);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, John!', $command->getGreetingMessage());
    }

    /** @test */
    public function it_can_run_console_command_by_object_and_optional_parameters()
    {
        $command = $this->runConsoleCommand(new GenericCommand, ['--name' => 'Jane']);

        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Hello, Jane!', $command->getGreetingMessage());
    }
}
