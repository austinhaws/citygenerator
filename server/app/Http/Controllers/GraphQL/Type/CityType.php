<?php
namespace App\Http\Controllers\GraphQL\Type;

use BeeEye\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class CityType extends GraphQLType
{
    protected $attributes = [
        'name' => 'City',
        'description' => 'A generated City',
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the city'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the city'
            ]
        ];
    }
}
