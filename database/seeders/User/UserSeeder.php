<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'testemail@email.com',
            'password' => Hash::make('password')
        ]);

        DB::table('users')->insert([
            'name' => 'Test User 2 ',
            'email' => 'testemail2@email.com',
            'password' => Hash::make('password')
        ]);
    }
}
