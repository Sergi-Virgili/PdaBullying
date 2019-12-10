<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function store(Request $request)
    {
        
    $user = User::create([
        'name' => $request->name,
        'surName'=> $request->surName,
        'email'=>$request->email,
        'password'=>$request->password,
        'entity'=>$request->entity,
        'street'=>$request->street,
        'number'=>$request->number,
        'city'=>$request->city,
        'CP'=>$request->CP,
    ]);
    return response()->json($user, 201);

    }
}
