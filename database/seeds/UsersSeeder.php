<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('user'),
            ]
         ]);
    }
}
