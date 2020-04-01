<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_users')->insert([
        [
            'username' => "admin",
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ], 
        [
            'username' => "abc",
            'email' => 'abc@gmail.com',
            'password' => 'abc',
        ]
        ]);
    }
}
