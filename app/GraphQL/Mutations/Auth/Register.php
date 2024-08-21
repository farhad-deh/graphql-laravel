<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Auth;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class Register extends Mutation
{
    protected $attributes = [
        'name' => 'auth/Register',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Token');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::string()
            ],
            'email' => [
                'type' => Type::string()
            ],
            'password' => [
                'type' => Type::string()
            ],
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.unique' => 'This email is already taken.',
            'email.required' => 'This email is required.',
            'password.required' => 'This email is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password']),
        ]);

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->accessToken,
        ];
    }
}
