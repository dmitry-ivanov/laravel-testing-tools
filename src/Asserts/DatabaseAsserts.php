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
        /** @laravel-versions */
        $assert = method_exists($this, 'assertDatabaseHas') ? 'assertDatabaseHas' : 'seeInDatabase';

        foreach ($rows as $row) {
            $this->$assert($table, $row);
        }

        return $this;
    }

    protected function dontSeeInDatabaseMany($table, array $rows)
    {
        /** @laravel-versions */
        $assert = method_exists($this, 'assertDatabaseMissing') ? 'assertDatabaseMissing' : 'dontSeeInDatabase';

        foreach ($rows as $row) {
            $this->$assert($table, $row);
        }

        return $this;
    }
}
