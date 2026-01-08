<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    protected $fillable = [
        'profile_id',
        'iuran_tetap_per_tahun_nominal',
        'iuran_tetap_per_tahun_tgl_bayar',
    ];

    protected $casts = [
        'iuran_tetap_per_tahun_tgl_bayar' => 'date:Y-m-d'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
