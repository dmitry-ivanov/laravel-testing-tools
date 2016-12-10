<?php

namespace Illuminated\Testing\Asserts;

trait DatabaseAsserts
{
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
