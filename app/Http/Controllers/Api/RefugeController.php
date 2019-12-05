<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Refuge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\Resource;

class RefugeController extends Controller
{

    public function index()
    {
        $refuges = Refuge::all();

        $refuges = Refuge::addGeoMarkerFields($refuges);

        return response()->json([
            'refuge'=>$refuges,
            'msg' => 'All resourrefugeces in the sistem'
            ]);
    }


    public function store(Request $request)
    {

        $refuge = Refuge::create([

            'name'=> $request->name,
            'description'=> $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng,

        ]);

        // TODO REFACTORING AND USER ID
        $user = User::find(1);
        $map = $user->map;
        $map->refuges()->attach($refuge->id);

        return response()->json($refuge, 201);
    }


    public function show(Resource $resource)
    {

    }


    public function update(Request $request, Resource $resource)
    {

    }


    public function destroy(Resource $resource)
    {

    }
}
