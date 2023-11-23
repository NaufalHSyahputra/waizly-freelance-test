<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get All Employees And Return it to JSON
        $employees = Employee::all();
        return response()->json([
            'messages' => 'Get All Employees Successfully',
            'data' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->only([
            'name',
            'job_title',
            'salary',
            'department',
            'join_date',
        ]));
        return response()->json([
            'messages' => 'Create Employees Successfully',
            'data' => $employee
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //Get Employee And Return it to JSON
        return response()->json([
            'messages' => 'Get Employee Successfully',
            'data' => $employee
        ], 200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //Check if Employee data exists
        if (!$employee) { 
            return response()->json([
                'messages' => 'Employee Not Found',
            ], 404);
        }
        $employee->name = $request->name;
        $employee->job_title = $request->job_title;
        $employee->salary = $request->salary;
        $employee->department = $request->department;
        $employee->join_date = $request->join_date;
        $employee->save();
        return response()->json([
            'messages' => 'Update Employee Successfully',
            'data' => $employee
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //Delete Employee
        $employee->delete();
        return response()->json([
            'messages' => 'Delete Employee Successfully',
        ], 200);
    }
}
