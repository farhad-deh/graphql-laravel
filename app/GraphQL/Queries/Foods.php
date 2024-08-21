<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Food;
use Closure;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class Foods extends Query
{
    protected $attributes = [
        'name' => 'foods',
        'description' => 'Get a restaurant and return foods'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Food');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $page = $args['page'] ?? 1;
        $limit = $args['limit'] ?? 5;
        return Food::where('restaurant_id', $args['id'])->paginate($limit, ['*'], 'page', $page);

    }
}
