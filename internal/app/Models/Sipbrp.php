<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sipbrp extends Model
{
    protected $fillable = [
        'profile_id',
        'sipbrp_no_persetujuan',
        'sipbrp_tgl_persetujuan',
        'sipbrp_sd_m3_tereka',
        'sipbrp_sd_m3_tertunjuk',
        'sipbrp_sd_m3_terukur',
        'sipbrp_sd_mt_tereka',
        'sipbrp_sd_mt_tertunjuk',
        'sipbrp_sd_mt_terukur',
        'sipbrp_luas_sumber_daya',
        'sipbrp_sd_tenaga_ahli',
        'sipbrp_cadang_m3_terkira',
        'sipbrp_cadang_m3_terbukti',
        'sipbrp_cadang_mt_terkira',
        'sipbrp_cadang_mt_terbukti',
        'sipbrp_luas_cadangan',
        'sipbrp_cadang_tenaga_ahli',
        'sipbrp_target_produksi_m3',
        'sipbrp_target_produksi_mt',
    ];

    protected $casts = [
        'sipbrp_tgl_persetujuan' => 'date:Y-m-d',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
