<?php

namespace App\Http\Controllers\Api;

use App\Map;
use App\User;
use App\Refuge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\Resource;

class MapController extends Controller
{
    public function show($userId) {


        $user = User::find($userId);
        $map = $user->map;
        $refuges = $map->refuges;
        $refuges = Refuge::addGeoMarkerFields($refuges);
        $center = [$user->map->lat , $user->map->lng];
        $zoom = $map->zoom;
        return response()->json([
            'center' => $center,
            'zoom' => $zoom,
            'refuges' => $refuges]) ;

    }
    public function attachRefuge($refugeId) {

        $userId = auth()->user()->id;
        $user = User::find($userId);
        $map = $user->map;
        $map->refuges()->attach($refugeId);

        return $map->refuges;

    }

    public function detachRefuge($refugeId) {

        $userId = auth()->user()->id;
        $user = User::find($userId);
        $map = $user->map;
        $map->refuges()->detach($refugeId);
        return $map->refuges;
    }

    public function updateProperties(Request $request, $mapId ) {
        $map = Map::findOrfail($mapId);
        $map->update([
            'lat' => $request->center[0],
            'lng' => $request->center[1],
            'zoom' => $request->zoom
        ]);
        return response()->json($map);
    }

}
