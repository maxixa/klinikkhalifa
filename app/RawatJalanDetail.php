<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawatJalanDetail extends Model
{
    protected $guarded = [];
    
    public function rawatJalan(){
        return $this->belongsTo('App\RawatJalan');
    }
}
