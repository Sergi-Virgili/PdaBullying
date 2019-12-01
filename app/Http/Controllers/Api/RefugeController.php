<?php

namespace App\Http\Controllers\Api;

use App\Refuge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\Resource;

class RefugeController extends Controller
{

    public function index()
    {
        $refuges = Refuge::all();
        foreach ($refuges as $refuge){
            $refuge['geoMarker']= [$refuge['lat'],$refuge['lng']];
        }

        return response()->json([
            'refuge'=>$refuges,
            'msg' => 'All resourrefugeces in the sistem'
            ]);
    }


    public function store(Request $request)
    {

        Refuge::create([

            'name'=> $request->name,
            'description'=> $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng,

        ]);

        return response()->json([], 201);
    }


    public function show(Resource $resource)
    {

    }


    public function edit(Resource $resource)
    {

    }


    public function update(Request $request, Resource $resource)
    {

    }


    public function destroy(Resource $resource)
    {

    }
}
