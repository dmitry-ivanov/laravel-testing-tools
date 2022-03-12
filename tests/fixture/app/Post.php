<?php

namespace Illuminated\Testing\Tests\App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Create a comment.
     */
    public function createComment(array $attributes): Comment
    {
        return $this->comments()->create($attributes);
    }

    /**
     * Create many comments.
     */
    public function createManyComments(array $comments): Collection
    {
        return $this->comments()->createMany($comments);
    }

    /**
     * Attach a comment.
     *
     * @noinspection PhpUnused
     */
    public function attachComment(array $attributes): Comment
    {
        return $this->createComment($attributes);
    }

    /**
     * Attach many comments.
     *
     * @noinspection PhpUnused
     */
    public function attachManyComments(array $comments): Collection
    {
        return $this->createManyComments($comments);
    }
}
