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
    return [
    	'firstname' => 'Jeniffer',
            'lastname'=>'Lopez',
            'mobile'=>'9841678443',
            'street'=>'1 Main St',
            'area'=>'CA',
            'city'=>'LA',
            'email'=> 'jlo@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('testtest'),

            'remember_token' => str_random(10),
            'deleted'=>1
    ];
});
