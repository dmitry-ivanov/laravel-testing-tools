<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected function assertEloquentTouchesEquals($class, array $touches)
    {
        $message = 'Failed asserting that Eloquent touches equals to specified value.';
        $this->assertEquals($touches, (new $class)->getTouchedRelations(), $message);
    }

    protected function assertEloquentTouchesNotEquals($class, array $touches)
    {
        $message = 'Failed asserting that Eloquent touches not equals to specified value.';
        $this->assertNotEquals($touches, (new $class)->getTouchedRelations(), $message);
    }

    protected function assertEloquentHasMany($class, $relation)
    {
        $this->assertMethodExists($class, $relation);

        $parent = factory($class)->create();
        $hasManyRelation = $parent->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $parentKey = $parent->getKeyName();
        $childModel = $hasManyRelation->getRelated();
        $childKey = $childModel->getKeyName();

        /* @laravel-versions */
        $childForeignKey = method_exists($hasManyRelation, 'getForeignKeyName')
            ? $hasManyRelation->getForeignKeyName() : last(explode('.', $hasManyRelation->getForeignKey()));

        $children = factory(get_class($childModel), 3)->create([$childForeignKey => $parent->{$parentKey}]);

        $this->assertCollectionsEqual($children, $parent->{$relation}, $childKey);
    }
}
