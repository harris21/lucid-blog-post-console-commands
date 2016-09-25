<?php

namespace Framework\Console\Commands;

use Illuminate\Http\Request;
use Lucid\Foundation\ServesFeaturesTrait;
use App\Services\Publisher\Features\CreatePostFeature;
use Illuminate\Console\Command;

class CreatePost extends Command
{
    use ServesFeaturesTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:post {title} {body}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blog post';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Request $request)
    {
        try {
            $request->replace(array('title' => $this->argument('title'), 'body' => $this->argument('body')));

            $post = $this->serve(CreatePostFeature::class);

            $this->info('Your post with title <comment>"'.$this->argument('title').'"</comment> has been created successfully.');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
