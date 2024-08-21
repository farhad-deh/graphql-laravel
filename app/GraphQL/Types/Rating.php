<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class Rating extends GraphQLType
{
    protected $attributes = [
        'name' => 'Rating',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'rating' => [
                'type' => Type::float()
            ],
            'comment' => [
                'type' => Type::string()
            ],
            'user' => [
                'type' => GraphQL::type('User')
            ],
            'food' => [
                'type' => GraphQL::type('Food')
            ],
        ];
    }
}
