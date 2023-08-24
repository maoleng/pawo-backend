<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Base
{

    protected $fillable = [
        'id',
        'name',
        'rate',
        'accountId',
        'token',
        'createdAt',
    ];

    protected $hidden = [
        'token',
    ];

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_user', 'userId', 'jobId')
            ->withPivot([
                'message', 'createdAt',
            ]);
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'evaluatorId');
    }

}
