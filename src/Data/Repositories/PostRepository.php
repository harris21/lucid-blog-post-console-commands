<?php

namespace App\Data\Repositories;

use App\Data\Models\Post\Post;
use App\Data\Repositories\Repository;

class PostRepository
{
    public function create($title, $body)
    {
        $post = new Post();

        $post->title = $title;
        $post->body = $body;
// dd($post);
        $post->save();
// dd('s');
        return $post;
    }
}
