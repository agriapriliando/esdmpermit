<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iui extends Model
{
    protected $fillable = [
        'profile_id',
        'iui_no_izin',
        'iui_tgl_izin',
        'iui_status_permodalan_pmdn_pma',
        'iui_kontrak_kerja_sama',
    ];

    protected $casts = [
        'iui_tgl_izin' => 'date:Y-m-d'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
