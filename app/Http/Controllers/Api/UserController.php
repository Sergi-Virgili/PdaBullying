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


    public function delete() {

    }

    public function update() {

    }
}
