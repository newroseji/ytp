<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert(
            [
            'label' => 'Home',
            'url'=> '/',
            'category' => 'top',
            ]);
        DB::table('menus')->insert(
            [
            'label' => 'About',
            'url'=> '/about',
            'category' => 'top',
            ]);   
        DB::table('menus')->insert(
            [
            'label' => 'Ads',
            'url'=> '/ads',
            'category' => 'sub',
            ]); 
        DB::table('menus')->insert(
            [
            'label' => 'Matrimony',
            'url'=> '/matrimony',
            'category' => 'sub',
            ]);    
        DB::table('menus')->insert(
            [
            'label' => 'Rent',
            'url'=> '/rent',
            'category' => 'sub',
            ]); 
        
        DB::table('menus')->insert(
            [
            'label' => 'Jobs',
            'url'=> '/jobs',
            'category' => 'sub',
            ]); 
        DB::table('menus')->insert(
            [
            'label' => 'Apparels',
            'url'=> '/apparels',
            'category' => 'sub',
            ]);  
        DB::table('menus')->insert(
            [
            'label' => 'Referrals',
            'url'=> '/referrals',
            'category' => 'sub',
            ]);           
    }
}
