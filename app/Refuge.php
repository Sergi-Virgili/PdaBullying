<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refuge extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function maps() {
       return $this->belongsToMany(Map::class);
    }

    public function types() {
        $this->belongsToMany(Type::class);
    }


    public static function addGeoMarkerFields($refuges) {
        foreach ($refuges as $refuge){
            $refuge['geoMarker']= [$refuge['lat'],$refuge['lng']];
        }
        return $refuges;
    }
}
