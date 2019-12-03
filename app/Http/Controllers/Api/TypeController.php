<?php

namespace App\Http\Controllers\Api;

use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $type = Type::create($request->all());
            return response()->json($type, 201);
        }
        catch(Exception $exception)
        {
            dd($exception);
        }
    }
}
