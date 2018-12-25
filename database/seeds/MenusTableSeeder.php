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
            'label' => 'Tablets',
            'url'=> '/tablets',
            'category' => 'sub',
            ]); 
        DB::table('menus')->insert(
            [
            'label' => 'Auto',
            'url'=> '/auto',
            'category' => 'sub',
            ]);    
        DB::table('menus')->insert(
            [
            'label' => 'Desktops',
            'url'=> '/desktops',
            'category' => 'sub',
            ]); 
        DB::table('menus')->insert(
            [
            'label' => 'Laptops',
            'url'=> '/laptops',
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
            'label' => 'Real Estates',
            'url'=> '/realestates',
            'category' => 'sub',
            ]);             
    }
}
