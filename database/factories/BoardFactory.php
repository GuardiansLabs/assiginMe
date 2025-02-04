<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Board;
use Faker\Generator as Faker;

$factory->define(Board::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->text(10),
        'user_id'     => 1, // secret
    ];
});
