<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\Schema;

trait DatabaseAsserts
{
    /**
     * Assert that the database has the given table.
     */
    protected function assertDatabaseHasTable(string $table): void
    {
        $this->assertTrue(
            Schema::hasTable($table),
            "Failed asserting that database has table `{$table}`.",
        );
    }

    /**
     * Assert that the database doesn't have the given table.
     */
    protected function assertDatabaseMissingTable(string $table): void
    {
        $this->assertFalse(
            Schema::hasTable($table),
            "Failed asserting that database missing table `{$table}`.",
        );
    }

    /**
     * Assert that the database has all the given rows.
     */
    protected function assertDatabaseHasMany(string $table, array $rows): self
    {
        foreach ($rows as $row) {
            $this->assertDatabaseHas($table, $row);
        }

        return $this;
    }

    /**
     * Assert that the database doesn't have all the given rows.
     */
    protected function assertDatabaseMissingMany(string $table, array $rows): self
    {
        foreach ($rows as $row) {
            $this->assertDatabaseMissing($table, $row);
        }

        return $this;
    }
}
