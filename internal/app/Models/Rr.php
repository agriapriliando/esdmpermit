<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rr extends Model
{
    protected $fillable = [
        'profile_id',
        'rr_no_persetujuan',
        'rr_tgl_persetujuan',
        'rr_tahun',
        'rr_nominal_yang_ditetapkan',
        'rr_nominal_yang_ditempatkan',
    ];

    protected $casts = [
        'rr_tgl_persetujuan' => 'date:Y-m-d',
    ];
}
