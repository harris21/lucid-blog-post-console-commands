<?php

namespace App\Data\Models\Post;

use Eloquent;

class Post extends Eloquent
{
    protected $fillable = ['title', 'body'];
}
