<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Properties;
use Faker\Generator as Faker;

$factory->define(Properties::class, function (Faker $faker) {
    return [
        'suburb'    => $faker->city,
        'state'     => $faker->state,
        'country'   => $faker->country
    ];
});
