<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index() {

        return User::all();
    }


    public function destroy($userId) {

        $user = User::findOrfail($userId);
        $user->delete();
        return response()->json(200);

    }

    public function update() {

    }
}
