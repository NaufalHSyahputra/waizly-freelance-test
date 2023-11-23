<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["sales_id" => 1, "employee_id" => 1, "sales" => 15000],
            ["sales_id" => 2, "employee_id" => 2, "sales" => 12000],
            ["sales_id" => 3, "employee_id" => 3, "sales" => 18000],
            ["sales_id" => 4, "employee_id" => 1, "sales" => 20000],
            ["sales_id" => 5, "employee_id" => 4, "sales" => 22000],
            ["sales_id" => 6, "employee_id" => 5, "sales" => 19000],
            ["sales_id" => 7, "employee_id" => 6, "sales" => 13000],
            ["sales_id" => 8, "employee_id" => 2, "sales" => 14000],
        ];
        //Insert $data to SalesData Table
        DB::table('sales_data')->insert($data);
    }
}
