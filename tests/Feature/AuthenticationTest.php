<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testLoginSuccess(): void
    {
        // Create a employee for testing
        $employee = \App\Models\Employee::factory()->create();

        // Create a user for testing
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'employee_id' => $employee->employee_id
        ]);

        // Make a request to the login endpoint
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert the response status code and JSON structure
        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token',
            ]);
    }

    public function testLoginWithInvalidEmail()
    {
        // Create a employee for testing
        $employee = \App\Models\Employee::factory()->create();

        // Create a user for testing
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'employee_id' => $employee->employee_id
        ]);

        // Make a request to the login endpoint with invalid email
        $response = $this->postJson('/api/auth/login', [
            'email' => 'tester@example.com',
            'password' => 'password',
        ]);

        // Assert the response status code and JSON structure
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'User not found'
            ]);
    }

    public function testLoginWithInvalidPassword()
    {
        // Create a employee for testing
        $employee = \App\Models\Employee::factory()->create();

        // Create a user for testing
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'employee_id' => $employee->employee_id
        ]);

        // Make a request to the login endpoint with invalid email
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Assert the response status code and JSON structure
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Password is incorrect'
            ]);
    }

    public function testLogoutSuccess()
    {
        // Create a employee for testing
        $employee = \App\Models\Employee::factory()->create();

        // Create a user for testing
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'employee_id' => $employee->employee_id
        ]);

        //Login to Get Token
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $token = $response->json()['token'];
        $headers = ['Authorization' => 'Bearer ' . $token];

        $response_logout = $this->getJson('/api/auth/logout', $headers);

        $response_logout->assertStatus(200)
            ->assertJson([
                'message' => 'Logout successful'
            ]);

    }
}
