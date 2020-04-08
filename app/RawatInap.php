<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawatInap extends Model
{
    protected $guarded = [];
    
    public function rawatInapDetails(){
        return $this->hasMany('App\RawatInapDetail');
    }

    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
