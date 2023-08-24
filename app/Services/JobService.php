<?php

namespace App\Services;

use App\Models\Job;

class JobService extends ApiService
{

    protected $model = Job::class;

    protected function getOrderbyableFields(): array
    {
        return [
            'title', 'money', 'status', 'startedAt', 'finishedAt', 'deadline', 'createdAt',
        ];
    }

    protected function mapFilters(): array
    {
        return [];
    }

    protected function fields(): array
    {
        return [
            'title', 'description', 'categories', 'money', 'creatorId', 'status', 'freelancerId', 'startedAt',
            'finishedAt', 'deadline', 'createdAt',
        ];
    }

}
