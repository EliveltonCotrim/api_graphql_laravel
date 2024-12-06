<?php

declare(strict_types=1);

namespace App\GraphQL\Enums;

use Rebing\GraphQL\Support\EnumType;

class ProjectStatusEnum extends EnumType
{
    protected $attributes = [
        'name' => 'ProjectStatusEnum',
        'description' => 'The status of the project',
        'values' => [
            'ATIVO' => [
                'value' => 0,
                'description' => 'Inativo',
            ],
            'ACTIVE' => [
                'value' => 1,
                'description' => 'Ativo',
            ],
            'INPROGRESS' => [
                'value' => 2,
                'description' => 'Em Progresso',
            ],
            'COMPLETED' => [
                'value' => 3,
                'description' => 'Concluído',
            ],
        ],
    ];
}
