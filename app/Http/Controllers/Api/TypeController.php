<?php

namespace App\Http\Controllers\Api;

use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeCollection;
use App\Http\Resources\Type as TypeResource;

class TypeController extends Controller
{


    public function index()
    {
        return new TypeCollection(Type::paginate());
    }

    public function returnView()
    {
        return view('admin.type');
    }

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
    public function show(int $id)
    {
        try
        {
            $type = Type::findOrfail($id);
            return response()->json(new TypeResource($type));
        }
        catch(Exception $exception)
        {
            dd($exception);
        }
        
    }
    public function update(Request $request, int $id)
    {
        $type = Type::findOrfail($id);

        $type->update([
            'name' => $request->name,
            'description' => $request->description

        ]);
        
        return response()->json(new TypeResource($type));
    }

    public function destroy(int $id)
    {
        $type = Type::findOrfail($id);

        $type->delete();

        return response()->json(null, 204);
    }
}
