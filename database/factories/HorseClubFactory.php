<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\HorseClub::class, function (Faker $faker) {
    return [
        'capacity' => $faker->numberBetween(1, 100),
        'infraList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'contestList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'userList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'idUser' => $faker->numberBetween(1, 100000),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
