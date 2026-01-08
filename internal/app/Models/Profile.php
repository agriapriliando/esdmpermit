<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nama_pemegang_perizinan',
        'kabupaten_kota',
        'kecamatan',
        'desa_kelurahan',
        'luas_ha',
        'tahapan_iup',
        'komoditas',
        'nomor_induk_berusaha_nib',
        'nomor_npwp',
        'status_npwp',
        'jenis_izin',
        'nomor_sk_izin',
        'tgl_terbit_izin',
        'tgl_berakhir_izin',
        'alamat_perusahaan_berdasarkan_sk_izin',
        'nama_direktur_sesuai_sk_izin',
        'dewan_direksi_bod',
        'modal_kerja',
        'nama_pic',
        'no_hp_pic',
        'email_resmi_perusahaan',
        'nib_email_oss',
        'nib_nomor_hp_oss',
        'keterangan',
        'kontrak_kerja_sama',
        'jenis_bidang_sub_bidang_usaha_jasa'
    ];

    protected $casts = [
        'tgl_terbit_izin'     => 'date',
        'tgl_berakhir_izin'     => 'date',
    ];

    public function scopeSearch($query, $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->where('nama_pemegang_perizinan', 'like', "%{$term}%")
                    ->orWhere('nomor_induk_berusaha_nib', 'like', "%{$term}%");
            });
        }
        return $query;
    }
    public function scopeKomoditas($query, $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->where('komoditas', 'like', "%{$term}%");
            });
        }
        return $query;
    }
    public function scopeKabupaten_kota($query, $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->where('kabupaten_kota', 'like', "%{$term}%");
            });
        }
        return $query;
    }
    public function scopeJenis_izin($query, $term)
    {
        if ($term) {
            return $query->where(function ($q) use ($term) {
                $q->where('jenis_izin', $term);
            });
        }
        return $query;
    }

    // Relationship with Iuran Tetap model
    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }

    public function latestIuran()
    {
        return $this->hasOne(Iuran::class)->latestOfMany();
    }

    public function iuis()
    {
        return $this->hasMany(Iui::class);
    }
    public function latestIui()
    {
        return $this->hasOne(Iui::class)->latestOfMany();
    }

    public function kims()
    {
        return $this->hasMany(Kim::class);
    }
    public function latestKim()
    {
        return $this->hasOne(Kim::class)->latestOfMany();
    }

    public function ktts()
    {
        return $this->hasMany(Ktt::class);
    }
    public function latestKtt()
    {
        return $this->hasOne(Ktt::class)->latestOfMany();
    }

    public function handaks()
    {
        return $this->hasMany(Handak::class);
    }

    public function latestHandak()
    {
        return $this->hasOne(Handak::class)->latestOfMany();
    }

    public function bbcs()
    {
        return $this->hasMany(Bbc::class);
    }
    public function latestBbc()
    {
        return $this->hasOne(Bbc::class)->latestOfMany();
    }

    public function les()
    {
        return $this->hasMany(Le::class);
    }
    public function latestLe()
    {
        return $this->hasOne(Le::class)->latestOfMany();
    }

    public function pelabuhans()
    {
        return $this->hasMany(Pelabuhan::class);
    }
    public function latestPelabuhan()
    {
        return $this->hasOne(Pelabuhan::class)->latestOfMany();
    }
    public function pls()
    {
        return $this->hasMany(Pl::class);
    }
    public function latestPl()
    {
        return $this->hasOne(Pl::class)->latestOfMany();
    }

    public function pas()
    {
        return $this->hasMany(Pa::class);
    }
    public function latestPa()
    {
        return $this->hasOne(Pa::class)->latestOfMany();
    }

    public function rpts()
    {
        return $this->hasMany(Rpt::class);
    }
    public function latestRpt()
    {
        return $this->hasOne(Rpt::class)->latestOfMany();
    }
    public function rrs()
    {
        return $this->hasMany(Rr::class);
    }
    public function latestRr()
    {
        return $this->hasOne(Rr::class)->latestOfMany();
    }

    public function stks()
    {
        return $this->hasMany(Stk::class);
    }
    public function latestStk()
    {
        return $this->hasOne(Stk::class)->latestOfMany();
    }

    public function tbs()
    {
        return $this->hasMany(Tb::class);
    }
    public function latestTb()
    {
        return $this->hasOne(Tb::class)->latestOfMany();
    }

    public function reportmonths()
    {
        return $this->hasMany(Reportmonth::class);
    }

    public function latestReportmonth()
    {
        return $this->hasOne(Reportmonth::class)->latestOfMany();
    }
    public function triwulans()
    {
        return $this->hasMany(Triwulan::class);
    }

    public function latestTriwulan()
    {
        return $this->hasOne(Triwulan::class)->latestOfMany();
    }

    public function rippms()
    {
        return $this->hasMany(Rippm::class);
    }

    public function latestRippm()
    {
        return $this->hasOne(Rippm::class)->latestOfMany();
    }

    public function rkabops()
    {
        return $this->hasMany(Rkabop::class);
    }

    public function latestRkabop()
    {
        return $this->hasOne(Rkabop::class)->latestOfMany();
    }
}
