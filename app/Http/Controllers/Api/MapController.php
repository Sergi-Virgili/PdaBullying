<?php

namespace App\Http\Controllers\Api;

use App\Map;
use App\User;
use App\Refuge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\Resource;

class MapController extends Controller
{
    public function show($userId) {

        $user = User::find($userId);

        $refuges = $user->refuges();
        $refuges = Refuge::addGeoMarkerFields($refuges);

        return $refuges;

    }
}
