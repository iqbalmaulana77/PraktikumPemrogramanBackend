<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:75',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:8'
        ]);

        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($input);

        $data = [
            'statusCode' => 201,
            'message' => 'Success',
            'data' => $user
        ];

        return response()->json($data, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($input)) {
            $token = Auth::user()->createToken('auth_token');

            $data = [
                'statusCode' => 200,
                'message' => 'Success',
                'token' => $token->plainTextToken
            ];

            return response()->json($data, 200);
        } else {
            return response()->json([
                'statusCode' => 401,
                'message' => 'email or password wrong'
            ], 401);
        }
    }
}
