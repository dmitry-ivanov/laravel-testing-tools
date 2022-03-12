<?php

namespace Illuminated\Testing\Asserts;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

trait EloquentAsserts
{
    /**
     * Assert that the model's table name equals to the given value.
     */
    protected function assertEloquentTableEquals(string $class, string $table): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = "Failed asserting that Eloquent table equals to `{$table}`.";
        $this->assertEquals($table, $model->getTable(), $message);
    }

    /**
     * Assert that the model's table name doesn't equal to the given value.
     */
    protected function assertEloquentTableNotEquals(string $class, string $table): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = "Failed asserting that Eloquent table not equals to `{$table}`.";
        $this->assertNotEquals($table, $model->getTable(), $message);
    }

    /**
     * Assert that the model's primary key is incrementing.
     */
    protected function assertEloquentIsIncrementing(string $class): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent model has incrementing primary key.';
        $this->assertTrue($model->getIncrementing(), $message);
    }

    /**
     * Assert that the model's primary key is not incrementing.
     */
    protected function assertEloquentIsNotIncrementing(string $class): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent model has not incrementing primary key.';
        $this->assertFalse($model->getIncrementing(), $message);
    }

    /**
     * Assert that the model's `fillable` field equals to the given value.
     */
    protected function assertEloquentFillableEquals(string $class, array $fillable): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent fillable equals to specified value.';
        $this->assertEquals($fillable, $model->getFillable(), $message);
    }

    /**
     * Assert that the model's `fillable` field doesn't equal to the given value.
     */
    protected function assertEloquentFillableNotEquals(string $class, array $fillable): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent fillable not equals to specified value.';
        $this->assertNotEquals($fillable, $model->getFillable(), $message);
    }

    /**
     * Assert that the model's `dates` field equals to the given value.
     */
    protected function assertEloquentDatesEquals(string $class, array $dates): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent dates equals to specified value.';
        $this->assertEquals($dates, $model->getDates(), $message);
    }

    /**
     * Assert that the model's `dates` field doesn't equal to the given value.
     */
    protected function assertEloquentDatesNotEquals(string $class, array $dates): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent dates not equals to specified value.';
        $this->assertNotEquals($dates, $model->getDates(), $message);
    }

    /**
     * Assert that the model's `touches` field equals to the given value.
     */
    protected function assertEloquentTouchesEquals(string $class, array $touches): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent touches equals to specified value.';
        $this->assertEquals($touches, $model->getTouchedRelations(), $message);
    }

    /**
     * Assert that the model's `touches` field doesn't equal to the given value.
     */
    protected function assertEloquentTouchesNotEquals(string $class, array $touches): void
    {
        /** @var \Illuminate\Database\Eloquent\Model $model */
        $model = new $class;

        $message = 'Failed asserting that Eloquent touches not equals to specified value.';
        $this->assertNotEquals($touches, $model->getTouchedRelations(), $message);
    }

    /**
     * Assert that the model has the given `HasMany` relation.
     */
    protected function assertEloquentHasMany(string $class, string $relation): void
    {
        $this->assertMethodExists($class, $relation);

        /** @var \Illuminate\Database\Eloquent\Relations\HasMany $hasManyRelation */
        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $parentKey = $hasManyRelation->getParent()->getKeyName();
        $childModel = $hasManyRelation->getRelated();
        $childKey = $childModel->getKeyName();
        $childForeignKey = $hasManyRelation->getForeignKeyName();

        $parent = Factory::factoryForModel($class)->create();
        $children = Factory::factoryForModel(get_class($childModel))
            ->count(3)
            ->create([$childForeignKey => $parent->{$parentKey}]);

        $this->assertCollectionsEqual($children, $parent->{$relation}, $childKey);
    }

    /**
     * Assert that the model has `create` method for the given `HasMany` relation.
     */
    protected function assertEloquentHasCreateFor(string $class, string $relation, string $createMethod = ''): void
    {
        $this->assertMethodExists($class, $relation);

        /** @var \Illuminate\Database\Eloquent\Relations\HasMany $hasManyRelation */
        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $createMethod = !empty($createMethod) ? $createMethod : 'create' . Str::title(Str::singular($relation));
        $this->assertMethodExists($class, $createMethod);

        /** @var \Illuminate\Database\Eloquent\Model $child */
        $parent = Factory::factoryForModel($class)->create();
        $child = $parent->{$createMethod}(
            Factory::factoryForModel(get_class($hasManyRelation->getRelated()))
                ->make()
                ->toArray()
        );

        $this->assertEquals($child->fresh()->toArray(), $parent->{$relation}->first()->toArray());
    }

    /**
     * Assert that the model has `createMany` method for the given `HasMany` relation.
     */
    protected function assertEloquentHasCreateManyFor(string $class, string $relation, string $createManyMethod = ''): void
    {
        $this->assertMethodExists($class, $relation);

        /** @var \Illuminate\Database\Eloquent\Relations\HasMany $hasManyRelation */
        $hasManyRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(HasMany::class, $hasManyRelation);

        $createManyMethod = !empty($createManyMethod) ? $createManyMethod : 'createMany' . Str::title($relation);
        $this->assertMethodExists($class, $createManyMethod);

        $childModel = $hasManyRelation->getRelated();
        $childKey = $childModel->getKeyName();

        $parent = Factory::factoryForModel($class)->create();
        $children = $parent->{$createManyMethod}(
            Factory::factoryForModel(get_class($childModel))
                ->count(3)
                ->make()
                ->toArray()
        );

        $this->assertCollectionsEqual($children, $parent->{$relation}, $childKey);
    }

    /**
     * Assert that the model has the given `BelongsTo` relation.
     */
    protected function assertEloquentBelongsTo(string $class, string $relation): void
    {
        $this->assertMethodExists($class, $relation);

        /** @var \Illuminate\Database\Eloquent\Relations\BelongsTo $belongsToRelation */
        $belongsToRelation = (new $class)->{$relation}();
        $this->assertInstanceOf(BelongsTo::class, $belongsToRelation);

        $parentModel = $belongsToRelation->getRelated();
        $parentKey = $parentModel->getKeyName();
        $childForeignKey = $belongsToRelation->getForeignKeyName();

        $parent = Factory::factoryForModel(get_class($parentModel))->create();
        $child = Factory::factoryForModel($class)->create([$childForeignKey => $parent->{$parentKey}]);

        $this->assertEquals($parent->fresh()->toArray(), $child->{$relation}->toArray());
    }
}
