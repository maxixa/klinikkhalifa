<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawatKunjungan extends Model
{
    protected $guarded = [];
    
    public function rawatKunjunganDetails(){
        return $this->hasMany('App\RawatKunjunganDetail');
    }

    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
