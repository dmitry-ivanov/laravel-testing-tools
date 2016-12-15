<?php

class InteractsWithConsoleTest extends TestCase
{
    /** @test */
    public function it_can_run_console_command_by_class_name_via_object_and_return_it()
    {
        $command = $this->runConsoleCommand(GenericCommand::class);
        $this->assertInstanceOf(GenericCommand::class, $command);
        $this->assertEquals('Important!', $command->getSomethingImportant());
    }
}
