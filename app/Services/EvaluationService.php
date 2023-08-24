<?php

namespace App\Services;

use App\Enums\JobStatus;
use App\Models\Evaluation;
use http\Exception\RuntimeException;

class EvaluationService extends ApiService
{

    protected $model = Evaluation::class;

    protected function getOrderbyableFields(): array
    {
        return [
            'evaluatorId', 'evaluatedId', 'jobId', 'star', 'createdAt',
        ];
    }

    protected function mapFilters(): array
    {
        return [
            'name' => function ($value) {
                return (static function ($q) use ($value) {
                    $q->where('name', $value);
                });
            },
            'accountId' => function ($value) {
                return (static function ($q) use ($value) {
                    $q->where('accountId', $value);
                });
            },
        ];
    }

    protected function fields(): array
    {
        return [
            'evaluatorId', 'evaluatedId', 'jobId', 'star', 'message', 'createdAt',
        ];
    }

    protected function boot(): void
    {
        $this->on('creating', function ($model) {
            $job = services()->jobService()->findOrFail($model->getRaw('jobId'));
            $user = services()->userService()->findOrFail($model->getRaw('userId'));
            $evaluator = c('authed');
            if (($job->freelancerId !== $user->id && $job->freelancerId !== $evaluator->id) ||
                ($job->creatorId !== $user->id && $job->creatorId !== $evaluator->id))
            {
                throw new \RuntimeException('You do not do this job and you are not the creator of this job.');
            }
            $checkJobStatus = services()->jobService()->allStatusFailExcept($job->status, [JobStatus::PAID, JobStatus::STOPPED, JobStatus::OVERDUE]);
            if ($checkJobStatus !== true) {
                throw new \RuntimeException($checkJobStatus);
            }
            $evaluation = services()->evaluationService()->where('jobId', $job->id)->where('evaluatorId', $evaluator->id)
                ->where('evaluatedId', $user->id)->first();
            if ($evaluation !== null) {
                throw new \RuntimeException('You have evaluated this already');
            }
            $model->evaluatorId = $evaluator->id;
            $model->evaluatedId = $user->id;
            $model->createdAt = now();
        });
    }

}
