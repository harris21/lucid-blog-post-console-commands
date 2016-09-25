<?php

namespace App\Services\Publisher\Http\Controllers;

use Lucid\Foundation\Http\Controller;
use App\Services\Publisher\Features\CreatePostFeature;

class PostsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->serve(CreatePostFeature::class);
    }
}
