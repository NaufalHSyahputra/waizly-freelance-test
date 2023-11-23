<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login
     */
    public function login(LoginRequest $request) {
        //Check Email from $request if exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        //Check password from $request
        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password is incorrect'
            ], 401);
        }

        //Issue token from user with laravel sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        //Return Success With Token
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }

    /**
     * Logout
     */
    public function logout(Request $request) {
        //Logout in sanctum laravel 10
        $request->user()->currentAccessToken()->delete();

        // Return success message in JSON
        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }
}
