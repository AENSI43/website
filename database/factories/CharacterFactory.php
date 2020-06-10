<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Character;
use Faker\Generator as Faker;

$factory->define(Character::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName(),
        'lastname' => $faker->lastName,
        'birthdate' => $faker->date(),
        'biography' => $faker->text(),
        'active' => true,
        'valid' => true
    ];
});
