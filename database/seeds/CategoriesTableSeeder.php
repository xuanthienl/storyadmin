<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_categories')->insert([
            [
                'name' => "Best Stories",
                'img' => '1528366447.png',
            ], 
            [
                'name' => "Love Stories",
                'img' => '1528373442.png',
            ],
            [
                'name' => "Inspiration Stories",
                'img' => '1528373479.png',
            ], 
            [
                'name' => "Arabian Nights Stories",
                'img' => '1528373519.png',
            ],
            [
                'name' => "Bible Stories",
                'img' => '1528374412.png',
            ], 
            [
                'name' => "Kids Stories",
                'img' => '1528376444.png',
            ]
        ]);
    }
}
