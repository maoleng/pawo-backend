<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Base
{

    protected $fillable = [
        'title',
        'description',
        'categories',
        'money',
        'creatorId',
        'status',
        'freelancerId',
        'startedAt',
        'finishedAt',
        'deadline',
        'createdAt',
    ];

    protected $casts = [
        'categories' => 'json',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_user', 'jobId', 'userId')->withPivot([
            'message', 'createdAt',
        ]);
    }

}
