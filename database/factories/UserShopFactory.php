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

$factory->define(App\UserShop::class, function (Faker $faker) {
    return [
        'idUser' => $faker->numberBetween(1, 1000000),
        'horseList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'itemList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'infraList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'ridingStableList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'horseClubList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});