<?php

namespace Illuminated\Testing;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

trait InteractsWithConsole
{
    protected function runConsoleCommand($class)
    {
        $command = new $class;

        $command->setLaravel($this->app);
        $command->run(new ArrayInput([]), new BufferedOutput);

        return $command;
    }
}
