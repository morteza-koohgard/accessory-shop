<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Successfully created user!',
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        // Implement login logic here
    }
}
