<?php

namespace Illuminated\Testing\Helpers;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

trait ArtisanHelpers
{
    /**
     * The artisan output.
     *
     * @var \Symfony\Component\Console\Output\BufferedOutput
     */
    protected static $artisanOutput;

    /**
     * Run the given artisan console command.
     *
     * @param \Illuminate\Console\Command|string $command
     * @param array $parameters
     * @return \Illuminate\Console\Command
     */
    protected function runArtisan($command, array $parameters = [])
    {
        $command = $command instanceof Command ? $command : new $command;

        $command->setLaravel($this->app);

        self::$artisanOutput = new BufferedOutput;
        $command->run(new ArrayInput($parameters), self::$artisanOutput);

        return $command;
    }

    /**
     * Get artisan output.
     *
     * @return string
     */
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
