<?php

namespace Illuminated\Testing\Helpers;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

trait ArtisanHelpers
{
    protected function runArtisan($command, array $parameters = [])
    {
        if (!($command instanceof Command)) {
            $command = new $command;
        }

        $command->setLaravel($this->app);
        $command->run(new ArrayInput($parameters), new BufferedOutput);

        return $command;
    }
}
