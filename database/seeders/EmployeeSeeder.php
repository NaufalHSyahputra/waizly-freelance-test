<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Remove all data before insert new data
        DB::table('employees')->truncate();

        $data = [
            ["employee_id" => 1, "name" => "John Smith", "job_title" => "Manager", "salary" => 60000, "department" => "Sales", "join_date" => "2022-01-15"],
            ["employee_id" => 2, "name" => "Jane Doe", "job_title" => "Analyst", "salary" => 45000, "department" => "Marketing", "join_date" => "2022-02-01"],
            ["employee_id" => 3, "name" => "Mike Brown", "job_title" => "Developer", "salary" => 55000, "department" => "IT", "join_date" => "2022-03-10"],
            ["employee_id" => 4, "name" => "Anna Lee", "job_title" => "Manager", "salary" => 65000, "department" => "Sales", "join_date" => "2021-12-05"],
            ["employee_id" => 5, "name" => "Mark Wong", "job_title" => "Developer", "salary" => 50000, "department" => "IT", "join_date" => "2023-05-20"],
            ["employee_id" => 6, "name" => "Emily Chen", "job_title" => "Analyst", "salary" => 48000, "department" => "Marketing", "join_date" => "2023-06-02"],
        ];
        
        //Insert $data to Employees Table
        DB::table('employees')->insert($data);
        
    }
}
