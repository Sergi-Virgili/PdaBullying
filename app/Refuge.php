<?php

namespace App;

use App\Refuge;
use Illuminate\Database\Eloquent\Model;

class Refuge extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function maps() {
       return $this->belongsToMany(Map::class);
    }

    public function types() {
        return $this->belongsToMany(Type::class);
    }


    public static function addGeoMarkerFields($refuges) {
        foreach ($refuges as $refuge){
            $refuge['geoMarker']= [$refuge['lat'],$refuge['lng']];
        }
        return $refuges;
    }

    public static function length($refuges, $perPage) {
        $total = count($refuges) / $perPage;
        if (!is_int($total)){
            $total = (int) $total;
            $length = $total + 1;
            return $length;
        }
        return $total;
    }

    public static function addAuthorField() {
        
    }
}
