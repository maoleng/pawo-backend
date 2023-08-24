<?php

namespace App\Services;

use App\Models\User;

class UserService extends ApiService
{

    protected $model = User::class;

    protected function getOrderbyableFields(): array
    {
        return [
            'id', 'name', 'rate', 'accountId', 'createdAt',
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
            'name', 'rate', 'accountId', 'token', 'createdAt',
        ];
    }

    public function newQuery()
    {
        $query = parent::newQuery();

//        $query->where('is_active', true);
        return $query;
    }

}
