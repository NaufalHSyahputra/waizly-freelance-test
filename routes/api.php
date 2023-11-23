<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return hello world in json
    return response()->json([
        'message' => 'hello world'
    ]);
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    Route::middleware("auth:sanctum")->get('logout', 'logout');
});

Route::controller(EmployeeController::class)->middleware("auth:sanctum")->prefix('employee')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{employee}', 'show');
    Route::put('/{employee}', 'update');
    Route::delete('/{employee}', 'destroy');
});

