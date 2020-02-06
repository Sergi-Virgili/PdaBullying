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

    public function indexPublish(){

        $refuges = Refuge::all();

        $refugesList = Refuge::paginate(1);

        $pagination = [
            'total' => $refugesList->total(),
            'per_page' => $refugesList->perPage(),
            'current_page' => $refugesList->currentPage(),
            'length' => Refuge::length($refuges, $refugesList->perPage()),
        ];
            
        return response()->json([
            'refugesList'=>$refugesList,
            'pagination' =>$pagination,
            'msg' => 'Pagination fugeces in the sistem'
        ]);
    }


    public function store(Request $request)
    {
    
        $userId = auth()->user()->id;
        $user = auth()->user();


        $data = request()->validate([

            'name'=> '',
            'description'=> '',
            'lat' => '',
            'lng' => '',
            'house_number' => '',
            'road' => '',
            'city' => '',
            'state' => '',
            'country' => '',
            'postcode' => '',
            'phone' => '',
            'email' => '',
        ]);


        $refuge = request()->user()->refuges()->create($data);

        // [
        //     'user_id' => $userId,
        //     'name'=> $request->name,
        //     'description'=> $request->description,
        //     'lat' => $request->lat,
        //     'lng' => $request->lng,
        //     'house_number' => $request->house_number,
        //     'road' => $request->road,
        //     'city' => $request->city,
        //     'state' => $request->state,
        //     'country' => $request->country,
        //     'postcode' => $request->postcode,
        //     //'img_url' =>

        // ]



        $map = $user->map;
        $map->refuges()->attach($refuge->id);

        return response()->json([
            'data' => [
            'type' => 'refuges',
            'id' => $refuge->id,
            'attributes' => [
                'user_id' => $refuge->user_id,
                'name' => $refuge->name,
                'description' => $refuge->description,
                'lat' => $refuge->lat,
                'lng' => $refuge->lng
            ],
            'links' => url('/refuges/'.$refuge->id)
        ]] , 201);
    }


    public function show($refugeId)
    {
        $refuge = Refuge::find($refugeId);
        return response()->json($refuge, 201);
    }


    public function update(Request $request, int $id)
    {
        $refuge = Refuge::find($id);
        $refuge->update([
            'name' => $request->name,
            'description' => $request->description,
            'house_number' => $request->house_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'house_number' => $request->house_number,
            'city' => $request->city,
            'road' => $request->road,
        ]);
        

        $refuge->save();

        return response()->json($refuge);
    }


    public function destroy($refugeId)
    {
        $refuge = Refuge::findOrfail($refugeId);
        $refuge->delete();

        return response()->json('recurso eliminado');

    }

    public function publish(Request $request) {

        $refuge = Refuge::find($request->id);
        $refuge->is_Public = true;
        $refuge->update();
        return response()->json("$refuge->name is published");
    }

    public function hidde(Request $request) {

         $refuge = Refuge::find($request->id);
         $refuge->is_Public = false;
         $refuge->update();
         return response()->json("$refuge->name is hidden");
     }
}
