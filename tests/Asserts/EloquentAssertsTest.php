<?php

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
    public function it_has_eloquent_fillable_equals_assertion()
    {
        $this->assertEloquentFillableEquals(Post::class, ['title']);
    }

    /** @test */
    public function it_has_eloquent_fillable_not_equals_assertion()
    {
        $this->assertEloquentFillableNotEquals(Post::class, ['title', 'body']);
    }
}
