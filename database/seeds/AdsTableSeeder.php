<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\Ad::class, 100)->create();
        /*
        DB::table('ads')->insert(
            [
                'title' => 'Automobiles',
                'description'=> 'Automobiles',
                'price'=>mt_rand(1000, 9999),
                'user_id'=>1,
                'category_id'=>mt_rand(1,6)

            ]);
        */

    }
}
