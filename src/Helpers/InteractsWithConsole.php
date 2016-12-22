<?php

namespace Illuminated\Testing\Helpers;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

trait InteractsWithConsole
{
    protected function runConsoleCommand($class, array $parameters = [])
    {
        $command = new $class;

        $command->setLaravel($this->app);
        $command->run(new ArrayInput($parameters), new BufferedOutput);

        return $command;
    }
}
