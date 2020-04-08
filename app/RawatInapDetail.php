<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawatInapDetail extends Model
{
    protected $guarded = [];
    
    public function rawatInap(){
        return $this->belongsTo('App\RawatInap');
    }
}
