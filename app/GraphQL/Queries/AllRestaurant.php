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

class AllRestaurant extends Query
{
    protected $attributes = [
        'name' => 'allRestaurant',
        'description' => 'Returns all Restaurants',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Restaurant'));
    }

    public function args(): array
    {
        return [

        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Restaurant::all();
    }
}
