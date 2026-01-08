<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RkabopPeralatan extends Model
{
    protected $fillable = [
        'profile_id',
        'rkabop_id',
        'rkab_peralatan_pilih_tahun',
        'rkab_peralatan_jenis',
        'rkab_peralatan_merk',
        'rkab_peralatan_jumlah',
        'rkab_peralatan_no_plat',
        'rkab_peralatan_status_milik_sendiri',
        'rkab_peralatan_status_sewa',
        'rkab_peralatan_bbm_asal_kalteng',
        'rkab_peralatan_bbm_non_kalteng',
        'rkab_peralatan_rencana_pakai_bbm',
    ];
}
