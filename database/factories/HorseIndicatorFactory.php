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

$factory->define(App\HorseIndicator::class, function (Faker $faker) {
    return [
        'idHorse' => $faker->unique(false, 1000000)->numberBetween(1, 1000000),
        'idIndicator' => $faker->numberBetween(1, 100000),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
