<?php

namespace Trellis\Api\Domains\Talent;

use Lucid\Foundation\Validator;

class PostValidator extends Validator
{
    protected $rules = [
        'title' => ['required'],
        'body' => ['required'],
    ];

    public function validateInput($input, array $rules = [], array $messages = [])
    {
        return parent::validate($input, $this->rules);
    }
}
