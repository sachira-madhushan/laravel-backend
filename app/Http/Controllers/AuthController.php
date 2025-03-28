<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "confirmed|required"
        ]);

        $user = User::create($fields);

        $token = $user->createToken($user->name);

        return response()->json([
            "message" => "Registration success",
            "user" => $user,
            "token" => $token->plainTextToken

        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user || Hash::check($request->password, $user->password)) {
            $token = $user->createToken($user->name);

            return response()->json([
                "message" => "Login success",
                "user" => $user,
                "token" => $token->plainTextToken

            ]);
        } else {
            return response()->json([
                "message" => "Incorrect email or password"
            ], 401);
        }
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json([
            "message"=>"You are logged out"
        ]);
    }
}
