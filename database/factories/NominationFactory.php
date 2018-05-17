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

$factory->define(App\Nomination::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'status' => $faker->randomElement(['inactive' ,'active']),
        'from_time' => $faker->dateTimeThisMonth('2018-12-30 21:00:00', 'Europe/Moscow'),
        'to_time' => $faker->dateTimeThisMonth('2018-12-30 21:00:00', 'Europe/Moscow'),
    ];
});
