<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermitworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permitworks')->insert([
            [
                // 1
                'name_permit' => 'Surat Persetujuan RKAB IUP Eksplorasi Mineral Bukan Logam',
                'desc_permit' => 'Surat Persetujuan RKAB IUP Eksplorasi Mineral Bukan Logam',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 2
                'name_permit' => 'Surat Persetujuan RKAB IUP Operasi Produksi Mineral Bukan Logam',
                'desc_permit' => 'Surat Persetujuan RKAB IUP Operasi Produksi Mineral Bukan Logam',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 3
                'name_permit' => 'Surat Persetujuan RKAB IUP Eksplorasi Mineral Bukan Logam Jenis Tertentu',
                'desc_permit' => 'Surat Persetujuan RKAB IUP Eksplorasi Mineral Bukan Logam Jenis Tertentu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 4
                'name_permit' => 'Surat Persetujuan RKAB IUP Operasi Produksi Mineral Bukan Logam Jenis Tertentu',
                'desc_permit' => 'Surat Persetujuan RKAB IUP Operasi Produksi Mineral Bukan Logam Jenis Tertentu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 5
                'name_permit' => 'Surat Persetujuan RKAB IUP Eksplorasi Batuan',
                'desc_permit' => 'Surat Persetujuan RKAB IUP Eksplorasi Batuan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 6
                'name_permit' => 'Surat Persetujuan RKAB IUP Operasi Produksi Batuan',
                'desc_permit' => 'Surat Persetujuan RKAB IUP Operasi Produksi Batuan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 7
                'name_permit' => 'Surat Persetujuan Laporan Eksplorasi IUP (Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu, dan Batuan)',
                'desc_permit' => 'Surat Persetujuan Laporan Eksplorasi IUP (Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu, dan Batuan)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 8
                'name_permit' => 'Surat Persetujuan Tekno – Ekonomi Studi Kelayakan IUP (Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu, dan Batuan)',
                'desc_permit' => 'Surat Persetujuan Tekno – Ekonomi Studi Kelayakan IUP (Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu, dan Batuan)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 9
                'name_permit' => 'Surat Persetujuan Studi Kelayakan IUP (Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu, dan Batuan)',
                'desc_permit' => 'Surat Persetujuan Studi Kelayakan IUP (Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu, dan Batuan)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 10
                'name_permit' => 'Surat Persetujuan Rencana Reklamasi Tahap Operasi Produksi dan Rencana Pascatambang IUP (Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu, dan Batuan)',
                'desc_permit' => 'Surat Persetujuan Rencana Reklamasi Tahap Operasi Produksi dan Rencana Pascatambang IUP (Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu, dan Batuan)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 11
                'name_permit' => 'Surat Persetujuan Dokumen Rencana Teknis Penambangan SIPB',
                'desc_permit' => 'Surat Persetujuan Dokumen Rencana Teknis Penambangan SIPB',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 12
                'name_permit' => 'Surat Persetujuan Dokumen Rencana Penambangan SIPB',
                'desc_permit' => 'Surat Persetujuan Dokumen Rencana Penambangan SIPB',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 13
                'name_permit' => 'Surat Persetujuan Rencana Induk Pengembangan dan Pemberdayaan Masyarakat (RIPPM)',
                'desc_permit' => 'Surat Persetujuan Rencana Induk Pengembangan dan Pemberdayaan Masyarakat (RIPPM)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 14
                'name_permit' => 'Surat Persetujuan Kepala Teknik Tambang (KTT)',
                'desc_permit' => 'Surat Persetujuan Kepala Teknik Tambang (KTT)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 15
                'name_permit' => 'Surat Persetujuan Kartu Izin Meledakkan (KIM)',
                'desc_permit' => 'Surat Persetujuan Kartu Izin Meledakkan (KIM)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 16
                'name_permit' => 'Surat Persetujuan Gudang Bahan Peledak (Handak)',
                'desc_permit' => 'Surat Persetujuan Gudang Bahan Peledak (Handak)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 17
                'name_permit' => 'Surat Angkut Asal Barang (SAAB)',
                'desc_permit' => 'Surat Angkut Asal Barang (SAAB)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 18
                'name_permit' => 'Surat Persetujuan Pembangunan Tangki Bahan Bakar Cair di WIUP',
                'desc_permit' => 'Surat Persetujuan Pembangunan Tangki Bahan Bakar Cair di WIUP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
