<?php

namespace App\Http\Controllers\Api;

use App\Type;
use App\User;
use Auth;
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
            'refuge' => $refuges,
            'msg' => 'All resource fugeces in the sistem'
        ]);
    }

    public function indexPublish()
    {

        $refuges = Refuge::all();

        $refugesList = Refuge::paginate(5);

        $pagination = [
            'total' => $refugesList->total(),
            'per_page' => $refugesList->perPage(),
            'current_page' => $refugesList->currentPage(),
            'length' => Refuge::length($refuges, $refugesList->perPage()),
        ];

        return response()->json([
            'refugesList' => $refugesList,
            'pagination' => $pagination,
            'msg' => 'Pagination fugeces in the sistem'
        ]);
    }


    public function store(Request $request)
    {

        $userId = auth()->user()->id;
        $user = auth()->user();


        $data = request()->validate([

            'name' => '',
            'description' => '',
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



        $typesId = $request->types;

        foreach ($typesId as $typeId) {
            $refuge->types()->attach($typeId);
        }



        $map = $user->map;
        $map->refuges()->attach($refuge->id);
        $types = [];
        foreach ($refuge->types as $type) {
            $typeResourse = [
                'id' => $type->id,
                'name' => $type->name
            ];
            array_push($types, $typeResourse);
        }


        return response()->json([
            'data' => [
                'type' => 'refuges',
                'id' => $refuge->id,
                'attributes' => [
                    'user_id' => $refuge->user_id,
                    'name' => $refuge->name,
                    'description' => $refuge->description,
                    'lat' => $refuge->lat,
                    'lng' => $refuge->lng,
                    'types' => $types

                ],
                'links' => url('/refuges/' . $refuge->id)
            ]
        ], 201);
    }


    public function show($refugeId)
    {
        $refuge = Refuge::find($refugeId);
        return response()->json($refuge, 201);
    }


    public function update(Request $request, int $id)
    {
        $user = Auth::user();
        $refuge = Refuge::find($id);

        if ($user->id == $refuge->user_id || $user->is_admin == true) {
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
        return response()->json(403);
    }


    public function destroy($refugeId)
    {
        $refuge = Refuge::findOrfail($refugeId);
        $user = Auth::user();
        if ($user->id == $refuge->user_id || $user->is_admin == true) {
            $refuge->delete();

            return response()->json('recurso eliminado', 200);
        }
        return response()->json([], 403);
    }

    public function publish(Request $request)
    {

        $refuge = Refuge::find($request->id);
        $user = Auth::user();
        if ($user->is_admin == true) {
            $refuge->is_Public = true;
            $refuge->update();

            return response()->json("$refuge->name is published");
        }
        return response()->json(403);
    }

    public function hidde(Request $request)
    {

        $refuge = Refuge::find($request->id);
        $user = Auth::user();
        if ($user->is_admin == true) {
            $refuge->is_Public = false;
            $refuge->update();
            return response()->json("$refuge->name is hidden");
        }
        return response()->json(403);
    }
}
