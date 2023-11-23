<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Database\Factories\UserFactory;
use Database\Factories\EmployeeFactory;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Testing\Fakes\Fake;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testGetAllEmployeesWithoutLogin(): void
    {
        //Call /api/employee without login
        $response = $this->getJson('/api/employee');

        $response->assertStatus(401);
    }
    public function testGetAllEmployeesWithLogin(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Call /api/employee with login
        $response = $this->getJson('/api/employee', $headers);

        $response->assertStatus(200)->assertJsonStructure([
            'message',
            'data'
        ]);
    }

    public function testGetEmployeeWithoutLogin(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();
        //Call /api/employee without login
        $response = $this->getJson('/api/employee/1');

        $response->assertStatus(401);
    }
    public function testGetEmployeeWithLogin(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Call /api/employee with login
        $response = $this->getJson('/api/employee/'.$employee->employee_id, $headers);

        $response->assertStatus(200)->assertJsonStructure([
            'message',
            'data'
        ]);
    }

    public function testAddEmployeeWithoutLogin(): void
    {
        //Call /api/employee without login
        $response = $this->postJson('/api/employee');

        $response->assertStatus(401);
    }
    public function testAddEmployeeWithLoginAndInvalidData(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Create New Data for Employee
        $new_employee = [
            "name" => "John Smith 3",
            "job_title" => "Manager",
            "salary" => 63000,
            "department" => "Sales"
        ];

        //Call /api/employee with login
        $response = $this->postJson('/api/employee',$new_employee, $headers);

        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors'
        ]);
    }

    public function testAddEmployeeWithLoginAndValidData(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Create New Data for Employee
        $new_employee = [
            "name" => "John Smith 3",
            "job_title" => "Manager",
            "salary" => 63000,
            "department" => "Sales",
            "join_date" => "2023-01-01"
        ];

        //Call /api/employee with login
        $response = $this->postJson('/api/employee',$new_employee, $headers);

        $response->assertStatus(201)->assertJsonStructure([
            'message'
        ]);
    }

    public function testUpdateEmployeeWithoutLogin(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();
        //Call /api/employee without login
        $response = $this->putJson('/api/employee/'.$employee->employee_id);

        $response->assertStatus(401);
    }
    public function testUpdateEmployeeWithLoginAndInvalidData(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Create New Data for Employee
        $new_employee = [
            "name" => "John Smith 3",
            "job_title" => "Manager",
            "salary" => 63000,
            "department" => "Sales"
        ];

        //Call /api/employee with login
        $response = $this->putJson('/api/employee/'.$employee->employee_id,$new_employee, $headers);

        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors'
        ]);
    }

    public function testUpdateEmployeeWithLoginAndInvalidEmployeeId(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Create New Data for Employee
        $new_employee = [
            "name" => "John Smith 3",
            "job_title" => "Manager",
            "salary" => 63000,
            "department" => "Sales",
            "join_date" => "2023-01-01"
        ];

        //Call /api/employee with login
        $response = $this->putJson('/api/employee/'.Factory::create()->randomDigitNot($employee->employee_id),$new_employee, $headers);

        $response->assertStatus(404);
    }

    public function testUpdateEmployeeWithLoginAndValidData(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Create New Data for Employee
        $new_employee = [
            "name" => "John Smith 3",
            "job_title" => "Manager",
            "salary" => 63000,
            "department" => "Sales",
            "join_date" => "2023-01-01"
        ];

        //Call /api/employee with login
        $response = $this->putJson('/api/employee/'.$employee->employee_id,$new_employee, $headers);

        $response->assertStatus(200)->assertJsonStructure([
            'message'
        ]);
    }

    public function testDeleteEmployeeWithoutLogin(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();
        //Call /api/employee without login
        $response = $this->deleteJson('/api/employee/'.$employee->employee_id);

        $response->assertStatus(401);
    }

    public function testDeleteEmployeeWithLoginAndInvalidEmployeeId(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Call /api/employee with login
        $response = $this->deleteJson('/api/employee/'.Factory::create()->randomDigitNot($employee->employee_id), [], $headers);

        $response->assertStatus(404);
    }

    public function testDeleteEmployeeWithLoginAndValidEmployeeId(): void
    {
        //Create an employee for testing
        $employee = EmployeeFactory::new()->create();

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
        //Get Token from response login
        $token = $response->json()['token'];
        
        //Create $headers with token
        $headers = ['Authorization' => 'Bearer ' . $token];

        //Call /api/employee with login
        $response = $this->deleteJson('/api/employee/'.$employee->employee_id, [], $headers);

        $response->assertStatus(200)->assertJsonStructure([
            'message'
        ]);
    }
}
