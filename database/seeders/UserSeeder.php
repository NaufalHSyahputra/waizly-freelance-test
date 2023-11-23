<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Remove all data before insert new data
        DB::table('users')->truncate();
        
        $data = [
            ["employee_id" => 1, 'email' => Factory::create()->unique()->safeEmail, 'password' => Hash::make('password')],
            ["employee_id" => 2, 'email' => Factory::create()->unique()->safeEmail, 'password' => Hash::make('password')],
            ["employee_id" => 3, 'email' => Factory::create()->unique()->safeEmail, 'password' => Hash::make('password')],
            ["employee_id" => 4, 'email' => Factory::create()->unique()->safeEmail, 'password' => Hash::make('password')],
            ["employee_id" => 5, 'email' => Factory::create()->unique()->safeEmail, 'password' => Hash::make('password')],
            ["employee_id" => 6, 'email' => Factory::create()->unique()->safeEmail, 'password' => Hash::make('password')]
        ];

        //Insert into users table
        DB::table('users')->insert($data);
    }
}
