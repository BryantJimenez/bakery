<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Complement;
use Faker\Generator as Faker;

$factory->define(Complement::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords=1),
        'description' => $faker->text($maxNbChars=200),
        'price' => $faker->randomFloat(2, 1, 40),
        'state' => $faker->randomElement(['1', '0'])
	];
});
