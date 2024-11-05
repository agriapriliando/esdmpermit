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
        $datalayanan = [
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
        ];

        $datanew = [
            [
                // 1
                'name_permit' => 'Surat Persetujuan Pembangunan Gudang Bahan Peledak ',
                'desc_permit' => '1. GAMBAR KONSTRUKSI GUDANG BAHAN PELEDAK <br>
                                2. GAMBAR SITUASI GUDANG BAHAN PELEDAK <br>
                                3. DETIL RENCANA WAKTU DAN TAHAPAN PEMBANGUNAN GUDANG BAHAN PELEDAK <br>
                                4. PENGESAHAN KEPALA TEKNIK TAMBANG <br>
                                5. PETA WIUP YANG SUDAH DIOVERLAY DENGAN KAWASAN HUTAN  <br>
                                6. BA PENENTUAN LOKASI RENCANA PEMBAGUNAN GUDANG BAHAN PELEDAK  <br>
                                7. LAPORAN PENYELIDIKAN TANAH <br>
                                8. RENCANA PONDASI GUDANG BAHAN PELEDAK <br>
                                9. PERHITUNGAN KEBUTUHAN MATERIAL BLASTING <br>
                                10.	FOTO SITUASI PERMUKAAN LAHAN <br>
                                11.	SALINAN IJIN LINGKUNGAN DAN FS <br>
                                12.	SURAT PERNYATAAN KEBENARAN DOKUMEN <br>
                                13.	PENGESAHAN RKAB PT BKR <br>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                // 1
                'name_permit' => 'Dokumen Pengesahan Kepala Teknik Tambang (KTT)',
                'desc_permit' => '1. SURAT PERMOHONAN (TTD DIREKTUR UTAMA DAN CAP) <br>
                                2. SALINAN IZIN USAHA PERTAMBANGAN ( IUP ) <br>
                                3. SURAT PERNYATAAN TIDAK MEMILIKI KETERIKATAN DI PERUSAHAAN TAMBANG LAIN (TTD CALON KTT DAN METERAI) <br>
                                4. SURAT PERNYATAAN KOMITMEN MELAKSANAKAN TUGAS DAN TANGGUNG JAWAB KTT PALING SEDIKIT 2 TAHUN DIPERUSAHAAN YANG MENUNJUKNYA (TTD CALON KTT DAN METERAI) <br>
                                5. STRUKTUR ORGANISASI PERUSAHAAN YANG DITANDATANGANI OLEH PIMPINAN DAN DIBERI CAP BASAH PERUSAHAAN <br>
                                6. SURAT PERNYATAAN , BERMETERAI YANG DITANDATANGANI OLEH PIMPINAN TERTINGGI PERUSAHAAN YANG MENYATAKAN MENDUKUNG SEMUA PROGRAM KTT (TTD DAN CAP PERUSAHAAN) <br>
                                7. SURAT PERNYATAAN PERSETUJUAN PENGESAHAN KTT BERISI KEBENARAN DOKUMEN (TTD CAP PERUSAHAAN DIREKTUR DAN BERMETERAI) <br>
                                8. DAFTAR RIWAYAT HIDUP CALON KTT LENGKAP <br>
                                9. SALINAN SERTIFIKAT KOMPETENSI DAN MELAMPIRKAN BUKTI TELAH DIREGISTRASI OLEH LSP KE KESDM SERTIFIKAT KOMPETENSINYA <br>
                                10. SALINAN PENGESAHAN KTT (APABILA PERNAH MENJADI KTT) <br>
                                11. DOKUMEN BENEFICIAL OWNERSHIP (TTD DAN CAP PERUSAHAAN) <br>
                                12. SALINAN SURAT PERSETUJUAN FS/STUDI KELAYAKAN JIKA PADA TAHAPAN OPERASI PRODUKSI <br>
                                13. TERDAFTAR DI MINERBA ONE DATA INDONESIA (MODI) <br>
                                14. SURAT PENYATAAN TIDAK RANGKAP JABATAN KTT <br>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('permitworks')->insert($datanew);
    }
}
