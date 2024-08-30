<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {

    }

      public function register(RegisterRequest $request) {
         return ['message' => 'Welcome'];

        $data = $request->validate();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['email']),
        ]);

        $token = $user->createToken('main')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);

    }

      public function logout(LogoutRequest $request) {

    }
}
