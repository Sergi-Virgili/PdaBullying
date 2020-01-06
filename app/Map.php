<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Refuge;

class Map extends Model
{
    public function refuges() {
        return $this->belongsToMany(Refuge::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

}
