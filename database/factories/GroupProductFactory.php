<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Group\Group;
use App\Models\Group\GroupProduct;
use Faker\Generator as Faker;

$factory->define(GroupProduct::class, function (Faker $faker) {
    $products=Product::all()->pluck('id');
	$groups=Group::all()->pluck('id');
    return [
        'product_id' => $faker->randomElement($products),
        'group_id' => $faker->randomElement($groups)
    ];
});
