<?php

namespace Illuminated\Testing\Tests\App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];
    public $incrementing = false;
}
