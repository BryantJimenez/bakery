<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Complement;
use App\Models\Group\Group;
use App\Models\Group\ComplementGroup;
use Faker\Generator as Faker;

$factory->define(ComplementGroup::class, function (Faker $faker) {
    $groups=Group::all()->pluck('id');
    $complements=Complement::all()->pluck('id');
    return [
        'group_id' => $faker->randomElement($groups),
        'complement_id' => $faker->randomElement($complements)
    ];
});
