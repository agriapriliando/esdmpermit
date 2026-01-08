<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'profile_id',
        'model_dokumen',
        'jenis_dokumen',
        'judul_dokumen',
        'ket_dokumen',
        'link_dokumen',
        'size_dokumen',
        'ext_dokumen',
    ];

    // Relasi ke Profile
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
