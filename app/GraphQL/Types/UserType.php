<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type for Users'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
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
        ];
    }
}
