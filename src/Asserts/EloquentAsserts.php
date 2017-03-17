<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $parentKey = $hasManyRelation->getParent()->getKeyName();
        $childModel = $hasManyRelation->getRelated();
        $childKey = $childModel->getKeyName();

        /* @laravel-versions */
        $childForeignKey = method_exists($hasManyRelation, 'getForeignKeyName')
            ? $hasManyRelation->getForeignKeyName() : last(explode('.', $hasManyRelation->getForeignKey()));

        $parent = factory($class)->create();
        $children = factory(get_class($childModel), 3)->create([$childForeignKey => $parent->{$parentKey}]);

        $this->assertCollectionsEqual($children, $parent->{$relation}, $childKey);
    }

    protected function assertEloquentHasCreateFor($class, $relation, $createMethod = null)
    {
        $this->assertMethodExists($class, $relation);

        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $createMethod = !empty($createMethod) ? $createMethod : 'create' . title_case(str_singular($relation));
        $this->assertMethodExists($class, $createMethod);

        $parent = factory($class)->create();
        $child = $parent->{$createMethod}(
            factory(get_class($hasManyRelation->getRelated()))
                ->make()
                ->toArray()
        );

        $this->assertEquals($child->fresh()->toArray(), $parent->{$relation}->first()->toArray());
    }

    protected function assertEloquentHasCreateManyRelationsMethod($class, $relation, $createManyMethod = null)
    {
        $this->assertMethodExists($class, $relation);

        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $createManyMethod = !empty($createManyMethod) ? $createManyMethod : 'createMany' . title_case($relation);
        $this->assertMethodExists($class, $createManyMethod);

        $childModel = $hasManyRelation->getRelated();
        $childKey = $childModel->getKeyName();

        $parent = factory($class)->create();
        $children = $parent->{$createManyMethod}(
            factory(get_class($childModel), 3)
                ->make()
                ->toArray()
        );

        $this->assertCollectionsEqual($children, $parent->{$relation}, $childKey);
    }

    protected function assertEloquentBelongsTo($class, $relation)
    {
        $this->assertMethodExists($class, $relation);

        $belongsToRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(BelongsTo::class, $belongsToRelation);

        $parentModel = $belongsToRelation->getRelated();
        $parentKey = $parentModel->getKeyName();
        $childForeignKey = $belongsToRelation->getForeignKey();

        $parent = factory(get_class($parentModel))->create();
        $child = factory($class)->create([$childForeignKey => $parent->{$parentKey}]);

        $this->assertEquals($parent->fresh()->toArray(), $child->{$relation}->toArray());
    }
}
