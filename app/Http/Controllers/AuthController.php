<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields=$request->validate([
            "name"=>"required|string",
            "email"=>"required|email|unique:users",
            "password"=>"confirmed|required"
        ]);

        $user=User::create($fields);

        $token=$user->createToken($user->name);

        return response()->json([
            "message"=>"Registration success",
            "user"=>$user,
            "token"=>$token->plainTextToken

        ]);

    }


}
