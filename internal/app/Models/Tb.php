<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tb extends Model
{
    protected $fillable = [
        'profile_id',
        'no_sk_tanda_batas',
        'tgl_sk_tanda_batas',
        'tanda_batas_laporan_pemeliharaan',
    ];

    protected $casts = [
        'tgl_sk_tanda_batas' => 'date:Y-m-d',
    ];
}
