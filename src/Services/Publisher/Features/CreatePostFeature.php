<?php

namespace App\Services\Publisher\Features;

use App\Domains\Http\Jobs\RespondWithJsonJob;
use App\Domains\Post\Jobs\CreatePostJob;
use App\Domains\Post\Jobs\ValidatePostInputJob;
use Illuminate\Http\Request;
use Lucid\Foundation\Feature;

class CreatePostFeature extends Feature
{
    public function handle(Request $request)
    {
        $this->run(ValidatePostInputJob::class, ['input' => $request->input()]);

        $post = $this->run(CreatePostJob::class, [
            'title' => $request->input('title', null),
            'body' => $request->input('body', null),
        ]);

        return $this->run(new RespondWithJsonJob($post));
    }
}
