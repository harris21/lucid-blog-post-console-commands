<?php

namespace App\Data\Repositories;

use App\Data\Models\Post\Post;
use App\Data\Repositories\Repository;

class PostRepository extends Repository
{
    public function create($title, $body)
    {
        $post = new Post();

        $post->title = $title;
        $post->body = $body;

        $post->save();

        return $post;
    }
}
