<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request){

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($validateData);

        $accesToken = $user->createToken('authToken')->accessToken;



        return response()->json(['user' => $user, 'access_token' => $accesToken]);
    }

    public function login(Request $request) {

        $loginData = $request->validate([

            'email' => 'email|required',
            'password' => 'required'
        ]);

    }
}
