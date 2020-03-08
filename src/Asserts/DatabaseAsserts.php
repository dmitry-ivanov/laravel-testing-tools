<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Support\Facades\Schema;

trait DatabaseAsserts
{
    /**
     * Assert that database has the given table.
     *
     * @param string $table
     * @return void
     */
    protected function assertDatabaseHasTable(string $table)
    {
        $this->assertTrue(
            Schema::hasTable($table),
            "Failed asserting that database has table `{$table}`."
        );
    }

    /**
     * Assert that database doesn't have the given table.
     *
     * @param string $table
     * @return void
     */
    protected function assertDatabaseMissingTable(string $table)
    {
        $this->assertFalse(
            Schema::hasTable($table),
            "Failed asserting that database missing table `{$table}`."
        );
    }

    /**
     * Assert that database has all of the given rows.
     *
     * @param string $table
     * @param array $rows
     * @return $this
     */
    protected function assertDatabaseHasMany(string $table, array $rows)
    {
        foreach ($rows as $row) {
            $this->assertDatabaseHas($table, $row);
        }

        return $this;
    }

    /**
     * Assert that database doesn't have all of the given rows.
     *
     * @param string $table
     * @param array $rows
     * @return $this
     */
    protected function assertDatabaseMissingMany(string $table, array $rows)
    {
        foreach ($rows as $row) {
            $this->assertDatabaseMissing($table, $row);
        }

        return $this;
    }
}
