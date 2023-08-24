<?php

namespace App\Models;

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

}
