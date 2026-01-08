<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RippmDetail extends Model
{
    protected $fillable = [
        'profile_id',
        'rippm_id',
        'rippm_tahun',
        'rippm_pendidikan_rencana',
        'rippm_pendidikan_realisasi',
        'rippm_kesehatan_rencana',
        'rippm_kesehatan_realisasi',
        'rippm_kemandirian_rencana',
        'rippm_kemandirian_realisasi',
        'rippm_tenaga_kerja_rencana',
        'rippm_tenaga_kerja_realisasi',
        'rippm_sosbud_rencana',
        'rippm_sosbud_realisasi',
        'rippm_lingkungan_rencana',
        'rippm_lingkungan_realisasi',
        'rippm_lembaga_komunitas_rencana',
        'rippm_lembaga_komunitas_realisasi',
        'rippm_infrastruktur_rencana',
        'rippm_infrastruktur_realisasi',
    ];

    public function rippm()
    {
        return $this->belongsTo(Rippm::class);
    }
}
