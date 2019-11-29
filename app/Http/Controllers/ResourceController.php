<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    
    public function index()
    {
        $resources = Resource::all();
        foreach ($resources as $resource){
            $resource['geoMarker']= [$resource['lat'],$resource['lng']];
        }

        return response()->json([
            'resources'=>$resources,
            'msg' => 'All resources in the sistem'
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
