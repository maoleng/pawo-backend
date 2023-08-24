<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\RegisterJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Http\Requests\UserRequest;
use App\Services\JobService;
use App\Services\UserService;

class JobController extends ApiController
{
    public function getService()
    {
        return c(JobService::class);
    }

    public function getUpdateRequest()
    {
        return c(UpdateJobRequest::class);
    }

    public function register(RegisterJobRequest $request, $id)
    {
        $message = $request->validated()['message'];
        $job = services()->jobService()->findOrFail($id);
        dd($job);
    }

}
