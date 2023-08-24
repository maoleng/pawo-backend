<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\ChooserFreelancerRequest;
use App\Http\Requests\Job\RegisterJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
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

    public function register(RegisterJobRequest $request, $id): array
    {
        $user = c('authed');
        $message = $request->validated()['message'];

        $job = services()->jobService()->findOrFail($id);

        if ($job->users->where('id', $user->id)->isNotEmpty()) {
            return [
                'status' => false,
                'message' => 'You have registered this job before',
            ];
        }

        $job->users()->attach([$user->id => [
            'message' => $message,
            'createdAt' => now(),
        ]]);

        return [
            'status' => true,
            'message' => 'Register successfully',
        ];
    }

    public function choose(ChooserFreelancerRequest $request)
    {
        $user = services()->userService()->find($request->validated()['userId']);
        $job = $request->input('job');

        $freelancer = $job->freelancer;
        if ($freelancer !== null) {
            return [
                'status' => false,
                'message' => "You have chose $freelancer->accountId for doing this job.",
            ];
        }
        if ($job->users->where('id', $user->id)->isEmpty()) {
            return [
                'status' => false,
                'message' => 'This user not register this job',
            ];
        }

        $job->freelancerId = $user->id;
        $job->save();

        return [
            'status' => true,
            'message' => 'Choose freelancer successfully',
        ];
    }

}
