<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Triwulan extends Model
{
    protected $fillable = [
        'profile_id',
        'triwulan_tahun',
        'laporan_triwulan_i',
        'laporan_triwulan_ii',
        'laporan_triwulan_iii',
        'laporan_triwulan_iv',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
