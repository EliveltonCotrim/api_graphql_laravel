<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Project;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateProjectMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProject',
        'description' => 'A mutation to create a project'
    ];

    public function type(): Type
    {
        return GraphQL::type('Project');

    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'rules' => ['required', 'string', 'max:255'],
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
                'rules' => ['nullable', 'string', 'max:255'],
            ],
            'status' => [
                'name' => 'status',
                'type' => Type::int(),
                'rules' => ['required', 'in: 0, 1, 2, 3'],
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Project::create([
            'name' => $args['name'],
            'description' => $args['description'] ?? null,
            'status' => $args['status'],
        ]);
    }
}
