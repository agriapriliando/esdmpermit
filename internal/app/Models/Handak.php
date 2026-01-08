<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handak extends Model
{
    protected $fillable = [
        'profile_id',
        'handak_no_persetujuan',
        'handak_tgl',
        'handak_jenis_bahan',
        'handak_kapasitas_gudang',
        'handak_tgl_mulai',
        'handak_tgl_selesai',
    ];

    protected $casts = [
        'handak_tgl' => 'date:Y-m-d',
        'handak_tgl_mulai' => 'date:Y-m-d',
        'handak_tgl_selesai' => 'date:Y-m-d',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
