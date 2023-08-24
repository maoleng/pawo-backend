<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\JobService;
use App\Services\UserService;

class JobController extends ApiController
{
    public function getService()
    {
        return c(JobService::class);
    }

    protected function getStoreRequest()
    {
        return c(UserRequest::class);
    }


}
