<?php

namespace App\GraphQL\Schemas;

use App\GraphQL\Mutations\CreateUserMutation;
use App\GraphQL\Queries\UsersQuery;
use App\GraphQL\Types\UserType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class DefaultSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            'query' => [
                'users' => UsersQuery::class,
            ],

            'mutation' => [
                'createUser' => CreateUserMutation::class,
            ],

            'types' => [
                'User' => UserType::class,
            ],
        ];
    }
}
