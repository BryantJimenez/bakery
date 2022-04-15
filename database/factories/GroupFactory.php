<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Attribute;
use App\Models\Group\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
	$attributes=Attribute::all()->pluck('id');
	$min=$faker->numberBetween($min=0, $max=3);
	$max=$faker->numberBetween($min=0, $max=4);
	if ($min>$max) {
		$max=$min;
	}
	return [
        'name' => [
        	'es' => $faker->word,
        	'en' => $faker->word
        ],
        'condition' => $faker->randomElement(['1', '0']),
        'min' => $min,
        'max' => $max,
        'state' => $faker->randomElement(['1', '0']),
        'attribute_id' => $faker->randomElement($attributes)
	];
});
