<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class Restaurant extends GraphQLType
{
    protected $attributes = [
        'name' => 'Restaurant',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int()
            ],
            'name' => [
                'type' => Type::string()
            ],
            'average_rating' => [
                'type' => Type::float(),
            ],
            'address' => [
                'type' => Type::string()
            ],
            'foods' => [
                'type' => Type::listOf(GraphQL::type('Food'))
            ]
        ];
    }
}
