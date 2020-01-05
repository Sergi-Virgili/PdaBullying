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

        //TODO USER ID IS FAKED!!!!
        $user = User::find($userId);

        $refuges = $user->refuges();
        $refuges = Refuge::addGeoMarkerFields($refuges);
        $center = [$user->map->lat , $user->map->lng];
        $zoom = $user->map->zoom;
        return response()->json([
            'center' => $center,
            'zoom' => $zoom,
            'refuges' => $refuges]) ;

    }
    public function attachRefuge($refugeId) {

        //TODO TOKEN AUTH !!
        $user = User::find(1);
        $map = $user->map;
        $map->refuges()->attach($refugeId);

        return $user->refuges();
        $refuge = Refuge::find($refugeId);
        $msg = 'La Ubicación se ha añadido a su mapa';
        return $msg;
    }

    public function detachRefuge($refugeId) {
        $user = User::find(1);
        $map = $user->map;
        $map->refuges()->detach($refugeId);
        return $user->refuges();
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
