<?php

namespace Illuminated\Testing\Tests\Asserts;

use Illuminated\Testing\Tests\App\Category;
use Illuminated\Testing\Tests\App\Comment;
use Illuminated\Testing\Tests\App\Post;
use Illuminated\Testing\Tests\TestCase;

class EloquentAssertsTest extends TestCase
{
    /** @test */
    public function it_has_eloquent_table_equals_assertion()
    {
        $this->assertEloquentTableEquals(Post::class, 'posts');
    }

    /** @test */
    public function it_has_eloquent_table_not_equals_assertion()
    {
        $this->assertEloquentTableNotEquals(Post::class, 'users');
    }

    /** @test */
    public function it_has_eloquent_is_incrementing_assertion()
    {
        $this->assertEloquentIsIncrementing(Post::class);
    }

    /** @test */
    public function it_has_eloquent_is_not_incrementing_assertion()
    {
        $this->assertEloquentIsNotIncrementing(Category::class);
    }

    /** @test */
    public function it_has_eloquent_fillable_equals_assertion()
    {
        $this->assertEloquentFillableEquals(Post::class, ['title', 'publish_at']);
    }

    /** @test */
    public function it_has_eloquent_fillable_not_equals_assertion()
    {
        $this->assertEloquentFillableNotEquals(Post::class, ['title', 'body', 'publish_at']);
    }

    /** @test */
    public function it_has_eloquent_dates_equals_assertion()
    {
        $this->assertEloquentDatesEquals(Post::class, ['publish_at', 'created_at', 'updated_at']);
    }

    /** @test */
    public function it_has_eloquent_dates_not_equals_assertion()
    {
        $this->assertEloquentDatesNotEquals(Post::class, ['publish_at']);
    }

    /** @test */
    public function it_has_eloquent_touches_equals_assertion()
    {
        $this->assertEloquentTouchesEquals(Post::class, []);
    }

    /** @test */
    public function it_has_eloquent_touches_not_equals_assertion()
    {
        $this->assertEloquentTouchesNotEquals(Post::class, ['user']);
    }

    /** @test */
    public function it_has_eloquent_has_many_assertion()
    {
        $this->assertEloquentHasMany(Post::class, 'comments');
    }

    /** @test */
    public function it_has_eloquent_has_create_for_assertion()
    {
        $this->assertEloquentHasCreateFor(Post::class, 'comments');
    }

    /** @test */
    public function which_supports_optional_parameter_for_specifying_custom_create_method_name()
    {
        $this->assertEloquentHasCreateFor(Post::class, 'comments', 'attachComment');
    }

    /** @test */
    public function it_has_eloquent_has_create_many_for_assertion()
    {
        $this->assertEloquentHasCreateManyFor(Post::class, 'comments');
    }

    /** @test */
    public function which_also_supports_optional_parameter_for_specifying_custom_create_many_method_name()
    {
        $this->assertEloquentHasCreateManyFor(Post::class, 'comments', 'attachManyComments');
    }

    /** @test */
    public function it_has_eloquent_belongs_to_assertion()
    {
        $this->assertEloquentBelongsTo(Comment::class, 'post');
    }
}
