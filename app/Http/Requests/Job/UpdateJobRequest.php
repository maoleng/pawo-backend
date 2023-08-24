<?php

namespace App\Http\Requests\Job;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateJobRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'title' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'categories' => [
                'required',
                'array',
            ],
            'money' => [
                'required',
            ],
        ];
    }

}
