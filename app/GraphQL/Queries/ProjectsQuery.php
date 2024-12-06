<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Project;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ProjectsQuery extends Query
{
    protected $attributes = [
        'name' => 'projects',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Project'))));
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'rules' => ['nullable', 'string'],
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
                'rules' => ['nullable', 'string'],
            ],
            'status' => [
                'name' => 'status',
                'type' => Type::int(),
                'rules' => ['nullable', 'string'],
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo)
    {
        $query = Project::query();

        $query->when(isset($args['name']), function (Builder $query) use ($args) {
            return $query->where('name', 'like', '%' . $args['name'] . '%');
        });

        $query->when(isset($args['description']), function (Builder $query) use ($args) {
            return $query->where('description', 'like', '%' . $args['description'] . '%');
        });

        $query->when(isset($args['status']), function (Builder $query) use ($args) {
            return $query->where('status', $args['status']);
        });

        return $query->paginate(10);

    }
}
