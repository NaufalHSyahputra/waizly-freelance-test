<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'job_title' => Arr::random(['Manager', 'Analyst', 'Developer']),
            'salary' => fake()->numberBetween(40000, 70000),
            'department' => fake()->jobTitle(),
            'join_date' => fake()->date('Y-m-d')
        ];
    }
}
