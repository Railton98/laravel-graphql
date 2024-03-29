<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\GraphQL\Types\UserType;
use GraphQL;
use App\User;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'List of the users'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'id of the user in database'
            ],
            'paginate' => [
                'type' => Type::int(),
                'description' => 'quantity of registers'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'page of the list'
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return User::where('id', $args['id'])->get();
        }

        if (isset($args['paginate'])) {
            $page = 1;
            if (isset($args['page'])) {
                $page = $args['page'];
            }

            return User::paginate($args['paginate'], ['*'], 'page', $page);
        }

        return User::all();
    }
}
