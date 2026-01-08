<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reportmonth extends Model
{
    protected $fillable = [
        'profile_id',
        'tahun_laporan',
        // Kolom laporan per bulan (1-12)
        'laporan_1_rencana_produksi_utama',
        'laporan_1_rencana_produksi_sampingan',
        'laporan_1_realisasi_produksi_utama',
        'laporan_1_realisasi_produksi_sampingan',
        'laporan_1_realisasi_penjualan_utama',
        'laporan_1_realisasi_penjualan_sampingan',

        'laporan_2_rencana_produksi_utama',
        'laporan_2_rencana_produksi_sampingan',
        'laporan_2_realisasi_produksi_utama',
        'laporan_2_realisasi_produksi_sampingan',
        'laporan_2_realisasi_penjualan_utama',
        'laporan_2_realisasi_penjualan_sampingan',

        'laporan_3_rencana_produksi_utama',
        'laporan_3_rencana_produksi_sampingan',
        'laporan_3_realisasi_produksi_utama',
        'laporan_3_realisasi_produksi_sampingan',
        'laporan_3_realisasi_penjualan_utama',
        'laporan_3_realisasi_penjualan_sampingan',

        'laporan_4_rencana_produksi_utama',
        'laporan_4_rencana_produksi_sampingan',
        'laporan_4_realisasi_produksi_utama',
        'laporan_4_realisasi_produksi_sampingan',
        'laporan_4_realisasi_penjualan_utama',
        'laporan_4_realisasi_penjualan_sampingan',

        'laporan_5_rencana_produksi_utama',
        'laporan_5_rencana_produksi_sampingan',
        'laporan_5_realisasi_produksi_utama',
        'laporan_5_realisasi_produksi_sampingan',
        'laporan_5_realisasi_penjualan_utama',
        'laporan_5_realisasi_penjualan_sampingan',

        'laporan_6_rencana_produksi_utama',
        'laporan_6_rencana_produksi_sampingan',
        'laporan_6_realisasi_produksi_utama',
        'laporan_6_realisasi_produksi_sampingan',
        'laporan_6_realisasi_penjualan_utama',
        'laporan_6_realisasi_penjualan_sampingan',

        'laporan_7_rencana_produksi_utama',
        'laporan_7_rencana_produksi_sampingan',
        'laporan_7_realisasi_produksi_utama',
        'laporan_7_realisasi_produksi_sampingan',
        'laporan_7_realisasi_penjualan_utama',
        'laporan_7_realisasi_penjualan_sampingan',

        'laporan_8_rencana_produksi_utama',
        'laporan_8_rencana_produksi_sampingan',
        'laporan_8_realisasi_produksi_utama',
        'laporan_8_realisasi_produksi_sampingan',
        'laporan_8_realisasi_penjualan_utama',
        'laporan_8_realisasi_penjualan_sampingan',

        'laporan_9_rencana_produksi_utama',
        'laporan_9_rencana_produksi_sampingan',
        'laporan_9_realisasi_produksi_utama',
        'laporan_9_realisasi_produksi_sampingan',
        'laporan_9_realisasi_penjualan_utama',
        'laporan_9_realisasi_penjualan_sampingan',

        'laporan_10_rencana_produksi_utama',
        'laporan_10_rencana_produksi_sampingan',
        'laporan_10_realisasi_produksi_utama',
        'laporan_10_realisasi_produksi_sampingan',
        'laporan_10_realisasi_penjualan_utama',
        'laporan_10_realisasi_penjualan_sampingan',

        'laporan_11_rencana_produksi_utama',
        'laporan_11_rencana_produksi_sampingan',
        'laporan_11_realisasi_produksi_utama',
        'laporan_11_realisasi_produksi_sampingan',
        'laporan_11_realisasi_penjualan_utama',
        'laporan_11_realisasi_penjualan_sampingan',

        'laporan_12_rencana_produksi_utama',
        'laporan_12_rencana_produksi_sampingan',
        'laporan_12_realisasi_produksi_utama',
        'laporan_12_realisasi_produksi_sampingan',
        'laporan_12_realisasi_penjualan_utama',
        'laporan_12_realisasi_penjualan_sampingan',

        'laporan_keterangan',
    ];
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
