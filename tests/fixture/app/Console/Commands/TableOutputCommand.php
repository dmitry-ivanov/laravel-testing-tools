<?php

namespace Illuminated\Testing\Tests\App\Console\Commands;

use Illuminate\Console\Command;

class TableOutputCommand extends Command
{
    protected $signature = 'table-output';

    public function handle()
    {
        $rows = $this->getRows();
        $headers = array_keys($rows[0]);
        $this->table($headers, $rows);
    }

    private function getRows()
    {
        return [
            ['System' => 'Node-1', 'Status' => 'Enabled'],
            ['System' => 'Node-2', 'Status' => 'Enabled'],
            ['System' => 'Node-3', 'Status' => 'Enabled'],
        ];
    }
}
