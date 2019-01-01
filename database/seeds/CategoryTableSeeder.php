<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Category::class, 10)->create();

        /*
        DB::table('categories')->insert(
            [
                'name' => 'Automobiles',
                'description'=> 'Automobiles'
            ]);
            DB::table('categories')->insert(
                [
                    'name' => 'Beauty & Health',
                    'description'=> 'Beauty & Health'
                ]);
                DB::table('categories')->insert(
                    [
                        'name' => 'Books & Learning',
                        'description'=> 'Books & Learning'
                    ]);
                    DB::table('categories')->insert(
                        [
                            'name' => 'Business & Industrial',
                            'description'=> 'Business & Industrial'
                        ]);
                        DB::table('categories')->insert(
                            [
                                'name' => 'Computer & Peripherals',
                                'description'=> 'Computer & Peripherals'
                            ]);
                            DB::table('categories')->insert(
                                [
                                    'name' => 'Electronics',
                                    'description'=> 'Electronics'
                                ]);
        */

    }
}
