<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObatHerbal extends Model
{
    protected $guarded = [];
    
    public function obatHerbalDetails(){
        return $this->hasMany('App\ObatHerbalDetail');
    }
    
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
