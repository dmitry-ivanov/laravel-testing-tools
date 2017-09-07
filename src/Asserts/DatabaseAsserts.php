<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\Schema;

trait DatabaseAsserts
{
    protected function assertDatabaseHasTable($table)
    {
        $this->assertTrue(Schema::hasTable($table), "Failed asserting that database has table `{$table}`.");
    }

    protected function assertDatabaseMissingTable($table)
    {
        $this->assertFalse(Schema::hasTable($table), "Failed asserting that database missing table `{$table}`.");
    }

    protected function seeInDatabaseMany($table, array $rows)
    {
        foreach ($rows as $row) {
            $this->assertDatabaseHas($table, $row);
        }

        return $this;
    }

    protected function dontSeeInDatabaseMany($table, array $rows)
    {
        foreach ($rows as $row) {
            $this->assertDatabaseMissing($table, $row);
        }

        return $this;
    }
}
