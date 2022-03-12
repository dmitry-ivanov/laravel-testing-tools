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
     */
    protected static BufferedOutput|string $artisanOutput;

    /**
     * Run the given artisan console command.
     */
    protected function runArtisan(Command|string $command, array $parameters = []): Command
    {
        $command = $command instanceof Command ? $command : new $command;

        $command->setLaravel($this->app);

        self::$artisanOutput = new BufferedOutput;
        $command->run(new ArrayInput($parameters), self::$artisanOutput);

        return $command;
    }

    /**
     * Get artisan output.
     */
    protected function getArtisanOutput(): string
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
