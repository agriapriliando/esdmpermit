<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rkabop extends Model
{
    protected $fillable = [
        'profile_id',
        'rkabop_no_persetujuan',
        'rkabop_tgl_persetujuan',
        // Sumber Daya Tahun I
        'rkabop_sd_thn_i_m3_tereka',
        'rkabop_sd_thn_i_m3_tertunjuk',
        'rkabop_sd_thn_i_m3_terukur',
        'rkabop_sd_thn_i_mt_tereka',
        'rkabop_sd_thn_i_mt_tertunjuk',
        'rkabop_sd_thn_i_mt_terukur',
        // Sumber Daya Tahun II
        'rkabop_sd_thn_ii_m3_tereka',
        'rkabop_sd_thn_ii_m3_tertunjuk',
        'rkabop_sd_thn_ii_m3_terukur',
        'rkabop_sd_thn_ii_mt_tereka',
        'rkabop_sd_thn_ii_mt_tertunjuk',
        'rkabop_sd_thn_ii_mt_terukur',
        // Sumber Daya Tahun III
        'rkabop_sd_thn_iii_m3_tereka',
        'rkabop_sd_thn_iii_m3_tertunjuk',
        'rkabop_sd_thn_iii_m3_terukur',
        'rkabop_sd_thn_iii_mt_tereka',
        'rkabop_sd_thn_iii_mt_tertunjuk',
        'rkabop_sd_thn_iii_mt_terukur',
        // Tenaga Ahli Sumber Daya
        'rkabop_sd_tenaga_ahli',
        // Cadangan
        'rkabop_cadangan_thn_i_terkira',
        'rkabop_cadangan_thn_i_terbukti',
        'rkabop_cadangan_thn_ii_terkira',
        'rkabop_cadangan_thn_ii_terbukti',
        'rkabop_cadangan_thn_iii_terkira',
        'rkabop_cadangan_thn_iii_terbukti',
        // Tenaga Ahli Cadangan
        'rkabop_cadangan_tenaga_ahli',
        // Produksi Tahun I
        'rkabop_prod_thn_i_target_m3_utama',
        'rkabop_prod_thn_i_target_m3_sampingan',
        'rkabop_prod_thn_i_realisasi_m3_utama',
        'rkabop_prod_thn_i_realisasi_m3_sampingan',
        'rkabop_prod_thn_i_target_mt_utama',
        'rkabop_prod_thn_i_target_my_sampingan',
        'rkabop_prod_thn_i_realisasi_mt_utama',
        'rkabop_prod_thn_i_realisasi_mt_sampingan',
        // Produksi Tahun II
        'rkabop_prod_thn_ii_target_m3_utama',
        'rkabop_prod_thn_ii_target_m3_sampingan',
        'rkabop_prod_thn_ii_realisasi_m3_utama',
        'rkabop_prod_thn_ii_realisasi_m3_sampingan',
        'rkabop_prod_thn_ii_target_mt_utama',
        'rkabop_prod_thn_ii_target_my_sampingan',
        'rkabop_prod_thn_ii_realisasi_mt_utama',
        'rkabop_prod_thn_ii_realisasi_mt_sampingan',
        // Produksi Tahun III
        'rkabop_prod_thn_iii_target_m3_utama',
        'rkabop_prod_thn_iii_target_m3_sampingan',
        'rkabop_prod_thn_iii_realisasi_m3_utama',
        'rkabop_prod_thn_iii_realisasi_m3_sampingan',
        'rkabop_prod_thn_iii_target_mt_utama',
        'rkabop_prod_thn_iii_target_my_sampingan',
        'rkabop_prod_thn_iii_realisasi_mt_utama',
        'rkabop_prod_thn_iii_realisasi_mt_sampingan',
        // Pajak
        'rkabop_pajak_thn_i_daerah',
        'rkabop_pajak_thn_i_opsen',
        'rkabop_pajak_thn_ii_daerah',
        'rkabop_pajak_thn_ii_opsen',
        'rkabop_pajak_thn_iii_daerah',
        'rkabop_pajak_thn_iii_opsen',
        // Tenaga Kerja Tahun I
        'rkabop_tenaga_kerja_thn_i_lokal',
        'rkabop_tenaga_kerja_thn_i_non_lokal',
        'rkabop_tenaga_kerja_thn_i_tka',
        // Tenaga Kerja Tahun II
        'rkabop_tenaga_kerja_thn_ii_lokal',
        'rkabop_tenaga_kerja_thn_ii_non_lokal',
        'rkabop_tenaga_kerja_thn_ii_tka',
        // Tenaga Kerja Tahun III
        'rkabop_tenaga_kerja_thn_iii_lokal',
        'rkabop_tenaga_kerja_thn_iii_non_lokal',
        'rkabop_tenaga_kerja_thn_iii_tka',
    ];

    public function peralatans()
    {
        return $this->hasMany(RkabopPeralatan::class, 'rkabop_id');
    }
}
