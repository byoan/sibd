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

$factory->define(App\Newspaper::class, function (Faker $faker) {
    return [
        'dayDate' => $faker->unique(false, 100000)->date($format = 'Y-m-d', $max = 'now'),
        'agenda' => json_encode($faker->sentences(5)),
        'previousDayBestMoments' => json_encode($faker->sentences(5)),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
    ];
});
