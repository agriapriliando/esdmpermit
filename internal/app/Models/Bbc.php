<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bbc extends Model
{
    protected $fillable = [
        'profile_id',
        'bbc_tangki_no_persetujuan',
        'bbc_tgl',
        'bbc_kapasitas_tangki',
        'bbc_tgl_mulai',
        'bbc_tgl_selesai',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
