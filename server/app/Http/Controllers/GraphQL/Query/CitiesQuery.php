<?php
namespace App\Http\Controllers\GraphQL\Query;

use BeeEye\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;

class CitiesQuery extends Query
{
    protected $attributes = [
        'name' => 'cities'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('City'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            // return User::where('id' , $args['id'])->get();
        } else {
            // return User::all();
        }
        return [['id' => '32', 'name' => 'charlie', 'address' => 'not better']];
    }
}
