<?php

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
            ['Date' => '2016-12-13 13:13:13', 'System' => 'Alpha', 'Status' => 'Enabled'],
            ['Date' => '2016-12-14 14:14:14', 'System' => 'Beta', 'Status' => 'Enabled'],
            ['Date' => '2016-12-15 15:15:15', 'System' => 'Gamma', 'Status' => 'Disabled'],
        ];
    }
}
