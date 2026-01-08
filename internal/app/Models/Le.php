<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Le extends Model
{
    protected $fillable = [
        'profile_id',
        'le_no_persetujuan',
        'le_tgl_persetujuan',
        'le_sd_m3_tereka',
        'le_sd_m3_tertunjuk',
        'le_sd_m3_terukur',
        'le_sd_mt_tereka',
        'le_sd_mt_tertunjuk',
        'le_sd_mt_terukur',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
