<?php

namespace Illuminated\Testing\Asserts;

trait EloquentAsserts
{
    protected function assertEloquentTableEquals($class, $table)
    {
        $message = "Failed asserting that Eloquent table equals to `{$table}`.";
        $this->assertEquals($table, (new $class)->getTable(), $message);
    }

    protected function assertEloquentTableNotEquals($class, $table)
    {
        $message = "Failed asserting that Eloquent table not equals to `{$table}`.";
        $this->assertNotEquals($table, (new $class)->getTable(), $message);
    }

    protected function assertEloquentFillableEquals($class, array $fillable)
    {
        $message = 'Failed asserting that Eloquent fillable equals to specified value.';
        $this->assertEquals($fillable, (new $class)->getFillable(), $message);
    }

    protected function assertEloquentFillableNotEquals($class, array $fillable)
    {
        $message = 'Failed asserting that Eloquent fillable not equals to specified value.';
        $this->assertNotEquals($fillable, (new $class)->getFillable(), $message);
    }
}
