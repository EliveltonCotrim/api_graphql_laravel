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

class UpdateProjectMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateProject',
        'description' => 'A mutation to update a project'
    ];

    public function type(): Type
    {
        return GraphQL::type('Project');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required', 'integer'],
            ],
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
                'rules' => ['required', 'integer'],
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $project = Project::findOrFail(intval($args['id']));
        $project->update([
            'name' => $args['name'] ?? $project->name,
            'description' => $args['description'] ?? $project->description,
            'status' => $args['status'] ?? $project->status,
        ]);

        return $project;
    }
}
