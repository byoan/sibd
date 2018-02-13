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

$factory->define(App\User::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\fr_FR\Address($faker));
    $faker->addProvider(new \Faker\Provider\fr_FR\PhoneNumber($faker));
    return [
        'username' => $faker->unique()->userName,
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'address' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'description' => $faker->sentence,
        'phone' => $faker->mobileNumber(),
        'birthDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'website' => 'http://google.fr',
        'ipAddress' => $faker->ipv4,
        'role' => array_rand([1, 2], 1),
        'sex' => array_rand(['M', 'F'], 1),
        'avatar' => $faker->imageUrl(600, 400, 'cats'),
        'inscriptionDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'connectionDate' => date('Y-m-d h:m:s'),
        'created_at' => date('Y-m-d h:m:s'),
        'updated_at' => date('Y-m-d h:m:s'),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
