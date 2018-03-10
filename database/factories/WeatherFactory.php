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

$factory->define(App\Weather::class, function (Faker $faker) {
    return [
        'typeWeather' => $faker->word,
        'title' => $faker->word,
        'description' => $faker->sentence,
        'picture' => $faker->imageUrl(600, 400, 'cats'),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
