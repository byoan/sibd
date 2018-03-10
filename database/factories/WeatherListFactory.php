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

$factory->define(App\WeatherList::class, function (Faker $faker) {
    return [
        'idNewspaper' => $faker->unique(true, 10000000)->numberBetween(1, 17587),
        'idWeather' => $faker->unique(true, 10000000)->numberBetween(1, 17587),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
