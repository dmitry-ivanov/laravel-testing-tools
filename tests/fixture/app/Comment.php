<?php

namespace Illuminated\Testing\Tests\App;

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
