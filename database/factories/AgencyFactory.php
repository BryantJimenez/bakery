<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Agency;
use Faker\Generator as Faker;

$factory->define(Agency::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords=2),
        'route' => $faker->sentence($nbWords=2),
        'description' => $faker->text($maxNbChars=200),
        'price' => $faker->randomFloat(2, 1, 40),
        'state' => $faker->randomElement(['1', '0'])
    ];
});
