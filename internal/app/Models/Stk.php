<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stk extends Model
{
    protected $fillable = [
        'profile_id',
        'stk_no_persetujuan',
        'stk_tgl_persetujuan',
        'stk_sd_m3_tereka',
        'stk_sd_m3_tertunjuk',
        'stk_sd_m3_terukur',
        'stk_sd_mt_tereka',
        'stk_sd_mt_tertunjuk',
        'stk_sd_mt_terukur',
        'stk_luas_sumber_daya',
        'stk_sd_tenaga_ahli',
        'stk_cadang_m3_terkira',
        'stk_cadang_m3_terbukti',
        'stk_cadang_mt_terkira',
        'stk_cadang_mt_terbukti',
        'stk_luas_cadangan',
        'stk_cadang_tenaga_ahli',
        'stk_target_produksi_m3',
        'stk_target_produksi_mt',
    ];

    protected $casts = [
        'stk_tgl_persetujuan' => 'date:Y-m-d',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
