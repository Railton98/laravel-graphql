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

class UserPaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'userPaginate',
        'description' => 'Pagineted list of the users'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('user');
    }

    public function args(): array
    {
        return [
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
        $paginate = 15;
        if (isset($args['paginate'])) {
            $paginate = $args['paginate'];
        }
        $page = 1;
        if (isset($args['page'])) {
            $page = $args['page'];
        }

        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $with = $fields->getRelations();

        return User::with($with)->paginate($paginate, ['*'], 'page', $page);
    }
}
