<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawatJalan extends Model
{
    protected $guarded = [];
    
    public function rawatJalanDetails(){
        return $this->hasMany('App\RawatJalanDetail');
    }

    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
