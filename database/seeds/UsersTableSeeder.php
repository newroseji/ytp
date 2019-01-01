<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
            'firstname' => 'Niraj',
            'lastname'=>'Byanjankar',
            'mobile'=>'9841259165',
            'street'=>'Chyasal',
            'area'=>'Patan',
            'city'=>'Lalitpur',
            'email'=> 'nirajbjk@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('testtest'),

            'remember_token' => str_random(10),
            'admin'=>1
            ]);

            DB::table('users')->insert(
                [
                'firstname' => 'Jane',
                'lastname'=>'Doe',
                'mobile'=>'9841000000',
                'street'=>'Ikhalakhu',
                'area'=>'Patan',
                'city'=>'Lalitpur',
                'email'=> 'jane.doe@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('test1234'),
    
                'remember_token' => str_random(10),
                ]);

                DB::table('users')->insert(
                    [
                    'firstname' => 'John',
                    'lastname'=>'Doe',
                    'mobile'=>'9841000022',
                    'street'=>'Durbar Marg',
                    'area'=>'Kingsway',
                    'city'=>'Kathmandu',
                    'email'=> 'john.doe@gmail.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('test1234'),
        
                    'remember_token' => str_random(10),
                    ]);
    }
}
