<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rpt extends Model
{
    protected $fillable = [
        'profile_id',
        'rpt_no_persetujuan',
        'rpt_tgl_persetujuan',
        'rpt_nominal_yang_ditetapkan',
        'rpt_nominal_yang_ditempatkan',
        'rpt_tahun_pembayaran',
    ];

    protected $casts = [
        'rpt_tgl_persetujuan' => 'date:Y-m-d',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
