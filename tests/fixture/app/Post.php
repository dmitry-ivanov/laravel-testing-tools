<?php

namespace Illuminated\Testing\Tests\App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Commentable;

    protected $table = 'posts';
    protected $fillable = ['title', 'publish_at'];
    protected $dates = ['publish_at'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function createComment(array $attributes)
    {
        return $this->comments()->create($attributes);
    }

    public function createManyComments(array $comments)
    {
        return $this->comments()->createMany($comments);
    }

    public function attachComment(array $attributes)
    {
        return $this->createComment($attributes);
    }

    public function attachManyComments(array $comments)
    {
        return $this->createManyComments($comments);
    }
}
