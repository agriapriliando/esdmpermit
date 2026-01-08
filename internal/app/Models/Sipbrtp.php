<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sipbrtp extends Model
{
    protected $fillable = [
        'profile_id',
        'sipbrtp_no_persetujuan',
        'sipbrtp_tgl_persetujuan',
        'sipbrtp_sd_m3_tereka',
        'sipbrtp_sd_m3_tertunjuk',
        'sipbrtp_sd_m3_terukur',
        'sipbrtp_sd_mt_tereka',
        'sipbrtp_sd_mt_tertunjuk',
        'sipbrtp_sd_mt_terukur',
        'sipbrtp_luas_sumber_daya',
        'sipbrtp_sd_tenaga_ahli',
        'sipbrtp_cadang_m3_terkira',
        'sipbrtp_cadang_m3_terbukti',
        'sipbrtp_cadang_mt_terkira',
        'sipbrtp_cadang_mt_terbukti',
        'sipbrtp_luas_cadangan',
        'sipbrtp_cadang_tenaga_ahli',
        'sipbrtp_target_produksi_m3',
        'sipbrtp_target_produksi_mt',
    ];

    protected $casts = [
        'sipbrtp_tgl_persetujuan' => 'date:Y-m-d',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
