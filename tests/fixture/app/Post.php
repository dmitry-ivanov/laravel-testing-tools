<?php

namespace Illuminated\Testing\Tests\App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Commentable;
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'publish_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['publish_at'];

    /**
     * Get the comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Create a comment.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createComment(array $attributes)
    {
        return $this->comments()->create($attributes);
    }

    /**
     * Create many comments.
     *
     * @param array $comments
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createManyComments(array $comments)
    {
        return $this->comments()->createMany($comments);
    }

    /**
     * Attach a comment.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @noinspection PhpUnused
     */
    public function attachComment(array $attributes)
    {
        return $this->createComment($attributes);
    }

    /**
     * Attach many comments.
     *
     * @param array $comments
     * @return \Illuminate\Database\Eloquent\Collection
     *
     * @noinspection PhpUnused
     */
    public function attachManyComments(array $comments)
    {
        return $this->createManyComments($comments);
    }
}
