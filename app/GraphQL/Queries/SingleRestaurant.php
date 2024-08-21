<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Restaurant;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class SingleRestaurant extends Query
{
    protected $attributes = [
        'name' => 'singleRestaurant',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('Restaurant');
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
        return Restaurant::whereId($args['id'])->first();
    }
}
