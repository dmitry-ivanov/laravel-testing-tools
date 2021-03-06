<?php

namespace Illuminated\Testing\Tests\App\Console\Commands;

use Illuminate\Console\Command;

class TableOutputCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table-output';

    /**
     * Handle the command.
     *
     * @return void
     */
    public function handle()
    {
        $rows = $this->getRows();
        $headers = array_keys($rows[0]);
        $this->table($headers, $rows);
    }

    /**
     * Get the rows.
     *
     * @return array
     */
    private function getRows()
    {
        return [
            ['System' => 'Node-1', 'Status' => 'Enabled'],
            ['System' => 'Node-2', 'Status' => 'Enabled'],
            ['System' => 'Node-3', 'Status' => 'Enabled'],
        ];
    }
}
