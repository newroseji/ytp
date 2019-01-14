<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Ad::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->paragraph,
        
        'price'=>mt_rand(1000, 9999)/ 10,
        'user_id'=>mt_rand(1,3),
        'category_id'=>mt_rand(1,10),
        'publish'=> Carbon::now(),
        'expires'=>Carbon::now()->addDay(),
    ];
});
