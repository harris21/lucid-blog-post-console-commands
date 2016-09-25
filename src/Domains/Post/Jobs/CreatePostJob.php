<?php
namespace App\Domains\Post\Jobs;

use App\Data\Repositories\PostRepository;
use Lucid\Foundation\Job;

class CreatePostJob extends Job
{
    private $title;
    private $body;

    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function handle(PostRepository $post)
    {
        return $post->create($this->title, $this->body);
    }
}
