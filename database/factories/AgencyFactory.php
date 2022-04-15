<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Agency;
use Faker\Generator as Faker;

$factory->define(Agency::class, function (Faker $faker) {
    return [
        'name' => [
        	'es' => $faker->sentence($nbWords=2),
        	'en' => $faker->sentence($nbWords=2)
        ],
        'route' => [
        	'es' => $faker->sentence($nbWords=2),
        	'en' => $faker->sentence($nbWords=2)
        ],
        'description' => [
        	'es' => $faker->text($maxNbChars=200),
        	'en' => $faker->text($maxNbChars=200)
        ],
        'price' => $faker->randomFloat(2, 1, 40),
        'state' => $faker->randomElement(['1', '0'])
    ];
});
