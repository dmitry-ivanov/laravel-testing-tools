<?php

namespace Illuminated\TestingTools\Tests\Fixture\App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['body'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
