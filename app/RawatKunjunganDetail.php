<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawatKunjunganDetail extends Model
{
    protected $guarded = [];
    
    public function rawatKunjungan(){
        return $this->belongsTo('App\RawatKunjungan');
    }
}
