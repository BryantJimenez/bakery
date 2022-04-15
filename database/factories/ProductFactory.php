<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
	$categories=Category::all()->pluck('id');
	return [
        'name' => [
        	'es' => $faker->sentence($nbWords=1),
        	'en' => $faker->sentence($nbWords=1)
        ],
        'description' => [
        	'es' => $faker->text($maxNbChars=200),
        	'en' => $faker->text($maxNbChars=200)
        ],
        'price' => $faker->randomFloat(2, 1, 40),
        'state' => $faker->randomElement(['1', '0']),
        'category_id' => $faker->randomElement($categories)
	];
});
