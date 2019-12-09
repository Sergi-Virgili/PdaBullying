<?php

namespace App\Http\Controllers\Api;

use App\Type;
use App\Http\Resources\Type as TypeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $type = Type::create($request->all());
            return response()->json(new TypeResource($type), 201);
        }
        catch(Exception $exception)
        {
            dd($exception);
        }
        
    }
}
