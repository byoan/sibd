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

$factory->define(App\Infrastructure::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
        'level' => $faker->numberBetween(1, 100),
        'description' => $faker->text(200),
        'family' => $faker->word,
        'price' => $faker->randomFloat(3, 1.00, 99.999),
        'ressourcesConsumption' => $faker->words(3, true),
        'itemCapacity' => $faker->randomDigitNotNull,
        'horseCapacity' => $faker->randomNumber(2),
        'itemList' => json_encode(array($faker->randomNumber(4), $faker->randomNumber(4), $faker->randomNumber(4))),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
