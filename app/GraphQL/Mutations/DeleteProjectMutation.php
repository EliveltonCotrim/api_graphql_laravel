<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Project;
use Closure;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rebing\GraphQL\Support\Mutation;

class DeleteProjectMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteProject',
        'description' => 'A mutation to delete a project'
    ];

    public function type(): Type
    {
        return Type::boolean();

    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required', 'integer'],
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $project = Project::findOrFail($args['id']);

        return $project->delete() ? true : false;


    }
}
