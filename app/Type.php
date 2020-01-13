<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ["name"];
    protected $guarded = ['id'];
    
    public function refuges() {
        return $this->belongsToMany(Refuge::class);
    }
}
