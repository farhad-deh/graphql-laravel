<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Rating;

use App\Models\Food;
use App\Models\Rating;
use Closure;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class StoreRating extends Mutation
{
    protected $attributes = [
        'name' => 'rating/StoreRating',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Rating');
    }

    public function args(): array
    {
        return [
            'food_id' => [
                'type' => Type::int()
            ],
            'rating' => [
                'type' => Type::float()
            ],
            'comment' => [
                'type' => Type::string()
            ],
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'food_id' => 'required|exists:foods,id',
            'rating' => 'required|numeric|min:1|max:5',
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        try {
            $rating = Rating::updateOrCreate([
                'user_id' => 2,
                'food_id' => $args['food_id'],
            ], [
                'rating' => $args['rating'],
                'comment' => $args['comment'],
            ]);
            Food::whereId($args['food_id'])->first()->restaurant->averageRating();
            return $rating;
        } catch (\Exception $exception) {
            logger($exception);
            return new Error('There was an error while trying to create rating.');
        }

    }
}
