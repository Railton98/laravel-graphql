<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\User;
use GraphQL;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type for Users',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'id of the user in database'
            ],
            'name'=> [
                'type' => Type::string(),
                'description' => 'name of the user in database'
            ],
            'email'=> [
                'type' => Type::string(),
                'description' => 'email of the user in database'
            ],
            'posts'=> [
                'type' => Type::listOf(GraphQL::type('post')),
                'description' => 'list of the posts by user in database',
                'query' => function (array $args, $query, $ctx) {
                    return $query->where('posts.active', true);
                }
            ],
        ];
    }
}
