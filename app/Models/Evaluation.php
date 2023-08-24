<?php

namespace App\Models;

class Evaluation extends Base
{

    protected $fillable = [
        'evaluatorId',
        'evaluatedId',
        'jobId',
        'star',
        'message',
        'createdAt',
    ];


}
