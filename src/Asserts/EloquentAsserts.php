<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

trait EloquentAsserts
{
    /**
     * Assert that the model's table name equals to the given value.
     *
     * @param string $class
     * @param string $table
     * @return void
     */
    protected function assertEloquentTableEquals(string $class, string $table)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = "Failed asserting that Eloquent table equals to `{$table}`.";
        $this->assertEquals($table, $model->getTable(), $message);
    }

    /**
     * Assert that the model's table name doesn't equal to the given value.
     *
     * @param string $class
     * @param string $table
     * @return void
     */
    protected function assertEloquentTableNotEquals(string $class, string $table)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = "Failed asserting that Eloquent table not equals to `{$table}`.";
        $this->assertNotEquals($table, $model->getTable(), $message);
    }

    /**
     * Assert that the model's primary key is incrementing.
     *
     * @param string $class
     * @return void
     */
    protected function assertEloquentIsIncrementing(string $class)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent model has incrementing primary key.';
        $this->assertTrue($model->getIncrementing(), $message);
    }

    /**
     * Assert that the model's primary key is not incrementing.
     *
     * @param string $class
     * @return void
     */
    protected function assertEloquentIsNotIncrementing(string $class)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent model has not incrementing primary key.';
        $this->assertFalse($model->getIncrementing(), $message);
    }

    /**
     * Assert that the model's `fillable` field equals to the given value.
     *
     * @param string $class
     * @param array $fillable
     * @return void
     */
    protected function assertEloquentFillableEquals(string $class, array $fillable)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent fillable equals to specified value.';
        $this->assertEquals($fillable, $model->getFillable(), $message);
    }

    /**
     * Assert that the model's `fillable` field doesn't equal to the given value.
     *
     * @param string $class
     * @param array $fillable
     * @return void
     */
    protected function assertEloquentFillableNotEquals(string $class, array $fillable)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent fillable not equals to specified value.';
        $this->assertNotEquals($fillable, $model->getFillable(), $message);
    }

    /**
     * Assert that the model's `dates` field equals to the given value.
     *
     * @param string $class
     * @param array $dates
     * @return void
     */
    protected function assertEloquentDatesEquals(string $class, array $dates)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent dates equals to specified value.';
        $this->assertEquals($dates, $model->getDates(), $message);
    }

    /**
     * Assert that the model's `dates` field doesn't equal to the given value.
     *
     * @param string $class
     * @param array $dates
     * @return void
     */
    protected function assertEloquentDatesNotEquals(string $class, array $dates)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent dates not equals to specified value.';
        $this->assertNotEquals($dates, $model->getDates(), $message);
    }

    /**
     * Assert that the model's `touches` field equals to the given value.
     *
     * @param string $class
     * @param array $touches
     * @return void
     */
    protected function assertEloquentTouchesEquals(string $class, array $touches)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent touches equals to specified value.';
        $this->assertEquals($touches, $model->getTouchedRelations(), $message);
    }

    /**
     * Assert that the model's `touches` field doesn't equal to the given value.
     *
     * @param string $class
     * @param array $touches
     * @return void
     */
    protected function assertEloquentTouchesNotEquals(string $class, array $touches)
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent touches not equals to specified value.';
        $this->assertNotEquals($touches, $model->getTouchedRelations(), $message);
    }

    /**
     * Assert that the model has the given `HasMany` relation.
     *
     * @param string $class
     * @param string $relation
     * @return void
     */
    protected function assertEloquentHasMany(string $class, string $relation)
    {
        $this->assertMethodExists($class, $relation);

        /** @var \Illuminate\Database\Eloquent\Relations\HasMany $hasManyRelation */
        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $parentKey = $hasManyRelation->getParent()->getKeyName();
        $childModel = $hasManyRelation->getRelated();
        $childKey = $childModel->getKeyName();
        $childForeignKey = $hasManyRelation->getForeignKeyName();

        $parent = factory($class)->create();
        $children = factory(get_class($childModel), 3)->create([$childForeignKey => $parent->{$parentKey}]);

        $this->assertCollectionsEqual($children, $parent->{$relation}, $childKey);
    }

    /**
     * Assert that the model has `create` method for the given `HasMany` relation.
     *
     * @param string $class
     * @param string $relation
     * @param string $createMethod
     * @return void
     */
    protected function assertEloquentHasCreateFor(string $class, string $relation, string $createMethod = '')
    {
        $this->assertMethodExists($class, $relation);

        /** @var \Illuminate\Database\Eloquent\Relations\HasMany $hasManyRelation */
        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $createMethod = !empty($createMethod) ? $createMethod : 'create' . Str::title(Str::singular($relation));
        $this->assertMethodExists($class, $createMethod);

        /** @var \Illuminate\Database\Eloquent\Model $child */
        $parent = factory($class)->create();
        $child = $parent->{$createMethod}(
            factory(get_class($hasManyRelation->getRelated()))
                ->make()
                ->toArray()
        );

        $this->assertEquals($child->fresh()->toArray(), $parent->{$relation}->first()->toArray());
    }

    /**
     * Assert that the model has `createMany` method for the given `HasMany` relation.
     *
     * @param string $class
     * @param string $relation
     * @param string $createManyMethod
     * @return void
     */
    protected function assertEloquentHasCreateManyFor(string $class, string $relation, string $createManyMethod = '')
    {
        $this->assertMethodExists($class, $relation);

        /** @var \Illuminate\Database\Eloquent\Relations\HasMany $hasManyRelation */
        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $createManyMethod = !empty($createManyMethod) ? $createManyMethod : 'createMany' . Str::title($relation);
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

    /**
     * Assert that the model has the given `BelongsTo` relation.
     *
     * @param string $class
     * @param string $relation
     * @return void
     */
    protected function assertEloquentBelongsTo(string $class, string $relation)
    {
        $this->assertMethodExists($class, $relation);

        /** @var \Illuminate\Database\Eloquent\Relations\BelongsTo $belongsToRelation */
        $belongsToRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(BelongsTo::class, $belongsToRelation);

        $parentModel = $belongsToRelation->getRelated();
        $parentKey = $parentModel->getKeyName();
        $childForeignKey = $belongsToRelation->getForeignKeyName();

        $parent = factory(get_class($parentModel))->create();
        $child = factory($class)->create([$childForeignKey => $parent->{$parentKey}]);

        $this->assertEquals($parent->fresh()->toArray(), $child->{$relation}->toArray());
    }
}
