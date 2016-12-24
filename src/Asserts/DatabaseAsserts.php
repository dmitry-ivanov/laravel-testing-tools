<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\Schema;

trait DatabaseAsserts
{
    protected function seeDatabaseTable($table)
    {
        $this->assertTrue(Schema::hasTable($table), "Failed asserting that database has table `{$table}`.");
    }

    protected function dontSeeDatabaseTable($table)
    {
        $this->assertFalse(Schema::hasTable($table), "Failed asserting that database not has table `{$table}`.");
    }

    protected function seeInDatabaseMany($table, array $rows)
    {
        foreach ($rows as $row) {
            $this->seeInDatabase($table, $row);
        }

        return $this;
    }

    protected function dontSeeInDatabaseMany($table, array $rows)
    {
        foreach ($rows as $row) {
            $this->dontSeeInDatabase($table, $row);
        }

        return $this;
    }
}
