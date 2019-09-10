<?php

namespace Illuminated\TestingTools\Tests\Fixture\App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];
    public $incrementing = false;
}
