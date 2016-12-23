<?php

namespace Illuminated\Testing\Helpers;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

trait ArtisanHelpers
{
    protected static $artisanOutput;

    protected function runArtisan($command, array $parameters = [])
    {
        if (!($command instanceof Command)) {
            $command = new $command;
        }

        $command->setLaravel($this->app);
        $command->run(new ArrayInput($parameters), (self::$artisanOutput = new BufferedOutput));

        return $command;
    }

    protected function getArtisanOutput()
    {
        $output = Artisan::output();
        if (!empty($output)) {
            self::$artisanOutput = $output;
        }

        if (self::$artisanOutput instanceof BufferedOutput) {
            self::$artisanOutput = self::$artisanOutput->fetch();
        }

        return self::$artisanOutput;
    }
}
