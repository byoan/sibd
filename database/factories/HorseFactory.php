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

$factory->define(App\Horse::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'race' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(3, 1, 100),
        'experience' => $faker->numberBetween(1, 1000),
        'level' => $faker->numberBetween(1, 100),
        'generalLevel' => $faker->numberBetween(1, 100),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
