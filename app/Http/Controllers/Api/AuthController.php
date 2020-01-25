<?php

namespace App\Http\Controllers\Api;

use auth;
use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Laravel\Passport\ClientRepository;


class AuthController extends Controller
{
    public function register(Request $request){

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        $accesToken = $user->createToken('authToken')->accessToken;



        return response()->json(['user' => $user, 'access_token' => $accesToken], 201);
    }

    public function login(Request $request) {

        $loginData = $request->validate([

            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){

            return response()->json(['message' => 'Error de autenticación']);


        };

        $accesToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['user' => auth()->user(), 'access_token' => $accesToken]);





    }
}
