<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Rating;

use App\Models\Rating;
use Closure;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class StoreRating extends Mutation
{
    protected $attributes = [
        'name' => 'StoreRating',
        'description' => 'A mutation to store a rating'
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
            'rate' => [
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
            'rate' => 'required|numeric|min:1|max:5',
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        try {
            $rating = Rating::updateOrCreate([
                'user_id' => auth()->id(),
                'food_id' => $args['food_id'],
            ], [
                'rate' => $args['rate'],
                'comment' => $args['comment'] ?? null,
            ]);
            $rating->food()->first()->restaurant->averageRating();
            return $rating;
        } catch (\Exception $exception) {
            return new Error('There was an error while trying to create rating.');
        }

    }
}
