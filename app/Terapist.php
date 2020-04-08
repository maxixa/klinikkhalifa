<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terapist extends Model
{
    protected $guarded = [];
    
    public function getProvinceAttribute($attribute) {
        return $this->provinceOptions() [$attribute];
    }
    
    public static function provinceOptions() {
        return[
            0=>"DKI Jakarta",
            1=>"Jawa Barat",
            2=>"Jawa Tengah",
            3=>"DI Yogyakarta",
            4=>"Jawa Timur",
            5=>"Bali",
            6=>"Aceh",
            7=>"Sumatera Utara",
            8=>"Sumatera Barat",
            9=>"Riau",
            10=>"Kepulauan Riau",
            11=>"Jambi",
            12=>"Bengkulu",
            12=>"Sumatera Selatan",
            14=>"Kepulauan Bangka Belitung",
            15=>"Lampung",
            16=>"Banten",
            17=>"Nusa Tenggara Barat",
            18=>"Nusa Tenggara Timur",
            19=>"Kalimantan Utara",
            20=>"Kalimantan Barat",
            21=>"Kalimantan Tengah",
            22=>"Kalimantan Selatan",
            23=>"Kalimantan Timur",
            24=>"Gorontalo",
            25=>"Sulawesi Utara",
            26=>"Sulawesi Barat",
            27=>"Sulawesi Tengah",
            28=>"Sulawesi Selatan",
            29=>"Sulawesi Tenggara",
            30=>"Maluku Utara",
            31=>"Maluku",
            32=>"Papua Barat",
            33=>"Papua",
        ];
    }

    public function getGenderAttribute($attribute) {
        return $this->genderOptions() [$attribute];
    }
    
    public static function genderOptions() {
        return[
            0=>"Laki-Laki",
            1=>"Perempuan",
        ];
    }
}
