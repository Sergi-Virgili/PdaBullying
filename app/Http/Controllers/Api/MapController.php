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

        $refuges = $user->refuges();
        $refuges = Refuge::addGeoMarkerFields($refuges);

        return $refuges;

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

    public function updateProperties(Request $request, $refugeId ) {

    }

}
