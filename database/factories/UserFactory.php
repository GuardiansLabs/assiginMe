<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt('secret'),
        'position'       => $faker->name,
        'avatar'         => $faker->name,
        'slug'           => $faker->name,
        'rol'            => $faker->numberBetween($min = 0, $max = 2),
    ];
});
