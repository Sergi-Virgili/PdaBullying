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
            'msg' => 'All resource fugeces in the sistem'
            ]);
    }


    public function store(Request $request)
    {

        $refuge = Refuge::create([

            'name'=> $request->name,
            'description'=> $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'house_number' => $request->house_number,
            'road' => $request->road,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postcode' => $request->postcode,

        ]);

        // TODO REFACTORING AND USER ID
        $user = User::find(1);
        $map = $user->map;
        $map->refuges()->attach($refuge->id);

        return response()->json($refuge, 201);
    }


    public function show($refugeId)
    {
        $refuge = Refuge::find($refugeId);
        return response()->json($refuge, 201);
    }


    public function update(Request $request, Resource $resource)
    {
        $refuge = Refuge::findOrfail($id);

        $refuge->update([
            'name' => $request->name,
            'description' => $request->description,
            'email'=>$request->email,
            'city'=>$request->city,
            'house_number'=>$request->house_number,
            'road'=>$request->road,
        ]);
        $refuge->save();
        return response()->json(new RefugeResource($refuge));
    }


    public function destroy($refugeId)
    {
        $refuge = Refuge::find($refugeId);
        $refuge->delete();

    }

    public function publish(Request $request) {
       // return $request;
        $refuge = Refuge::find($request->id);
        $refuge->is_Public = true;
        $refuge->update();
        return response()->json("$refuge->name is published");
    }

    public function hidde(Request $request) {
        // return $request;
         $refuge = Refuge::find($request->id);
         $refuge->is_Public = false;
         $refuge->update();
         return response()->json("$refuge->name is hidden");
     }
}
