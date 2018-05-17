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

$factory->define(App\CompetitiveWork::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'filial' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'url' => $faker->url,
        'correspondent' => $faker->name,
        'operator' => $faker->name,
    ];
});
