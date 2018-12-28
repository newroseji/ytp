<?php

use Faker\Generator as Faker;

$factory->define(App\Ad::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->paragraph,
        'category'=>$faker->word,
        'price'=>$faker->numberBetween(1000, 9000),
        'user_id'=>1
    ];
});
