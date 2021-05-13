<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => "Bernard",
            'middlename' => null,
            'lastname' => "Balansag",
            'status' => "active",
            'role' => "admin",
            'email' => "nhardbalansag@gmail.com",
            'password' => Hash::make('admin')
        ]);
    }
}
