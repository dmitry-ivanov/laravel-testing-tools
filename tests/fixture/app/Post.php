<?php

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Commentable;

    protected $table = 'posts';
    protected $fillable = ['title'];
}
