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

$factory->define(App\Att::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'value' => $faker->numberBetween(1, 100),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
