<?php

namespace App\Services;

use App\Enums\JobStatus;
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
            'id', 'title', 'description', 'categories', 'money', 'creatorId', 'status', 'freelancerId', 'startedAt',
            'finishedAt', 'deadline', 'createdAt',
        ];
    }

    protected function updateQuery()
    {
        $query = parent::updateQuery();

        return $query->where('creatorId', c('authed')->id);
    }

    protected function destroyQuery()
    {
        $query = parent::updateQuery();

        return $query->where('creatorId', c('authed')->id);
    }

    public function boot()
    {
        $this->on('creating', function ($model) {
            $model->creatorId = c('authed')->id;
            $model->status = JobStatus::WAITING;
            $model->createdAt = now();
        });


    }

}
