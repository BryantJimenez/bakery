<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => [
        	'es' => $faker->word,
        	'en' => $faker->word
        ],
        'state' => $faker->randomElement(['1', '0'])
    ];
});
