<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login credentials'
            ], 401);
        }

        $user = auth()->user();

        return response()->json([
            'token' => $user->createToken("API token for {$user->email}")->plainTextToken
        ]);
    }
}
