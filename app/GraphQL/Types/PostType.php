<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'A type for Post'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'id of the post in database'
            ],
            'title'=> [
                'type' => Type::string(),
                'description' => 'title of the post in database'
            ],
            'active'=> [
                'type' => Type::boolean(),
                'description' => 'status of the post in database (activated/deactivated)'
            ],
        ];
    }
}
