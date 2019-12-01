<?php

namespace App\Http\Controllers;

use App\Refuge;
use Illuminate\Http\Request;

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
