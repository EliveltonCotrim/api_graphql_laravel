<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Project;
use Closure;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ProjectQuery extends Query
{
    protected $attributes = [
        'name' => 'project',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Project'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required',  'integer'],
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        return Project::where('id', $args['id'])->get();
    }
}
