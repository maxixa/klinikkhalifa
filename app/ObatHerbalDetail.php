<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObatHerbalDetail extends Model
{
    protected $guarded = [];
    
    public function obatHerbal(){
        return $this->belongsTo('App\ObatHerbal');
    }
}
