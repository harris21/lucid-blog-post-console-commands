<?php
namespace App\Domains\Post\Jobs;

use Lucid\Foundation\Job;
use App\Domains\Post\PostValidator;

class ValidatePostInputJob extends Job
{
    private $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(PostValidator $validator)
    {
        return $validator->validateInput($this->input);
    }
}
