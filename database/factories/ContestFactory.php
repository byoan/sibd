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

$factory->define(App\Contest::class, function (Faker $faker) {
    return [
        'itemList' => $faker->word,
        'infraId' => $faker->unique(false, 1000000)->numberBetween(1, 100000),
        'beginDate' => date('Y-m-d h:m:s'),
        'endDate' => date('Y-m-d h:m:s'),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
