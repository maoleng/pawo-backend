<?php

namespace App\Models;

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

}
