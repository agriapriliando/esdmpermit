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
        DB::table('permitworks')->truncate();
        $daftarjudul = [
            [
                "1",
                "Kartu Izin Meledakan (KIM)",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Salinan Izin Usaha Pertambangan (IUP);</br>
4. Pengesahan Kepala Teknik Tambang (KTT);</br>
5. Sertifikat Juru Ledak;</br>
6. Pas Foto;</br>
7. KTP (Kartu Tanda Penduduk);</br>
8. NPWP (Nomor Pokok Wajib Pajak);</br>
9. SKCK (Surat Keterangan Catatan Kepolisian);</br>
10. Dokumen Beneficial Ownership (Ttd dan Cap Perusahaan);</br>
11. Job Deskripsi;</br>
12. Surat Pernyataan Kebenaran Dokumen;</br>"
            ],
            [
                "2",
                "Pengesahan Kepala Teknik Tambang (KTT)",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Salinan Izin Usaha Pertambangan (IUP);</br>
4. Surat Pernyataan Tidak Memiliki Keterikatan di Perusahaan Tambang Lain (Ttd Calon KTT dan Meterai);</br>
5. Surat Pernyataan Komitmen Melaksanakan Tugas dan Tanggung Jawab KTT Paling Sedikit 2 Tahun di Perusahaan yang Menunjuknya (Ttd Calon KTT dan Meterai);</br>
6. Struktur Organisasi Perusahaan yang Ditandatangani Oleh Pimpinan dan Diberi Cap Basah Perusahaan;</br>
7. Surat Pernyataan Bermeterai yang Ditandatangani Oleh Pimpinan Tertinggi Perusahaan yang Menyatakan Mendukung Semua Program KTT (Ttd dan Cap Perusahaan);</br>
8. Surat Pernyataan Persetujuan Pengesahan KTT Berisi Kebenaran Dokumen (Ttd Cap Perusahaan Direktur dan Bermeterai);</br>
9. Daftar Riwayat Hidup Calon KTT Lengkap;</br>
10. Salinan Sertifikat Kompetensi dan Melampirkan Bukti Telah Diregistrasi Oleh LSP Ke KESDM Sertifikat Kompetensinya;</br>
11. Salinan Pengesahan KTT (Apabila Pernah Menjadi KTT);</br>
12. Dokumen Beneficial Ownership (Ttd dan Cap Perusahaan);</br>
13. Salinan Surat Persetujuan FS/Studi Kelayakan Jika Pada Tahapan Operasi Produksi;</br>
14. Terdaftar di Minerba One Data Indonesia (MODI);</br>
15. Surat Penyataan Tidak Rangkap Jabatan KTT;</br>"
            ],
            [
                "3",
                "Persetujuan Dokumen Rencana Penambangan SIPB",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Persetujuan Rencana Teknis Penambangan SIPB;</br>
4. Persetujuan Dokumen Lingkungan Hidup;</br>
5. Surat Pernyataan Tenaga Ahli yang Bertanggung Jawab Terhadap Perhitungan Sumberdaya dan Cadangan (bermaterai)</br>"
            ],
            [
                "4",
                "Persetujuan Dokumen Rencana Teknis Penambangan SIPB",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Surat Pernyataan Tenaga Ahli yang Bertanggung Jawab Terhadap Perhitungan Sumberdaya dan Cadangan (bermaterai)</br>"
            ],
            [
                "5",
                "Persetujuan Laporan Akhir Eksplorasi",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Bukti Bayar Iuran Tetap Tahun Terakhir;</br>
4. Sertifikat CPI Sumberdaya atau Surat Pernyataan Tenaga Ahli yang Bertanggung Jawab Terhadap Perhitungan Sumberdaya;</br>
5. Pengangkatan / Pengesahan KTT;</br>
6. Persetujuan RKAB;</br>
7. Dokumen Eksplorasi (Pdf);</br>"
            ],
            [
                "6",
                "Persetujuan Pembangunan Gudang Bahan Peledak",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Gambar Konstruksi Gudang Bahan Peledak;</br>
4. Gambar Situasi Gudang Bahan Peledak;</br>
5. Detil Rencana Waktu dan Tahapan Pembangunan Gudang Bahan Peledak;</br>
6. Pengesahan Kepala Teknik Tambang;</br>
7. Peta WIUP yang Sudah Dioverlay dengan Kawasan Hutan;</br>
8. BA Penentuan Lokasi Rencana Pembagunan Gudang Bahan Peledak;</br>
9. Laporan Penyelidikan Tanah;</br>
10. Rencana Pondasi Gudang Bahan Peledak;</br>
11. Perhitungan Kebutuhan Material Blasting;</br>
12. Foto Situasi Permukaan Lahan;</br>
13. Salinan Ijin Lingkungan dan FS;</br>
14. Surat Pernyataan Kebenaran Dokumen;</br>
15. Pengesahan Rencana Kerja dan Anggaran Biaya (RKAB);</br>"
            ],
            [
                "7",
                "Persetujuan Pembangunan Tangki Timbun",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Gambar Konstruksi dan Peta Situasi Tangki Timbun;</br>
4. Detil Rencana Waktu dan Tahapan Pembangunan Tangki Timbun;</br>
5. Pengesahan Kepala Teknik Tambang (KTT);</br>
6. Peta WIUP yang Sudah di Overlay dengan Kawasan Hutan;</br>
7. BA Penentuan Lokasi Rencana Pembagunan Tangki Timbun;</br>
8. Laporan Hasil Kajian Daya Dukung Tanah dan Kestabilan Tanah;</br>
9. Rencana Jenis Tipe Pondasi Instalasi Bangunan;</br>
10. Foto Situasi Permukaan Lahan;</br>
11. Salinan Izin Lingkungan;</br>
12. Salinan FS/Studi Kelayakan;</br>"
            ],
            [
                "8",
                "Persetujuan Rencana Induk Program Pemberdayaan Masyarakat (RIPPM)",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Bukti Pembayaran Iuran Tetap Tahun Terakhir;</br>
4. Hasil Konsultasi Publik;</br>
5. Dokumen RIPPM (Pdf);</br>"
            ],
            [
                "9",
                "Persetujuan Rencana Kerja Dan Anggaran Biaya (RKAB) IUP Eksplorasi (Izin Baru)",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Bukti Pembayaran Iuran Tetap;</br>
4. Salinan Izin Usaha Pertambangan (IUP);</br>
5. Dokumen Rencana Kerja dan Anggaran Biaya (RKAB) (Pdf)</br>"
            ],
            [
                "10",
                "Persetujuan Rencana Kerja Dan Anggaran Biaya (RKAB) IUP Eksplorasi (Tahun Ke-2, Dst….)",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Persetujuan Rencana Kerja dan Anggaran Biaya (RKAB) Tahun Sebelumnya;</br>
4. Laporan Berkala Untuk IUP Eksplorasi;</br>
5. Bukti Pembayaran Iuran Tetap;</br>
6. Salinan Izin Usaha Pertambangan (IUP);</br>
7. Dokumen Rencana Kerja dan Anggaran Biaya (RKAB); (Pdf)</br>"
            ],
            [
                "11",
                "Persetujuan Rencana Kerja Dan Anggaran Biaya (RKAB) IUP Operasi Produksi",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Laporan Akhir Eksplorasi dan Persetujuannya;</br>
4. Laporan Studi Kelayakan dan Persetujuannya;</br>
5. Dokumen Lingkungan dan Persetujuan Lingkungan;</br>
6. Laporan Rencana Reklamasi dan Persetujuannya;</br>
7. Dokumen Rencana Pascatambang dan Persetujuannya;</br>
8. Laporan Rencana Kerja dan Anggaran Biaya (RKAB) Tahunan dan Persetujuannya;</br>
9. Laporan Rencana Induk PPM dan Persetujuannya;</br>
10. Pengesahan Kepala Teknik Tambang;</br>
11. Kartu Izin Meledakkan (Jika Menggunakan Peledakan);</br>
12. Persetujuan Tanda Batas Wilayah IUP Operasi Produksi;</br>
13. Laporan Bulanan Rencana Kerja dan Anggaran Biaya (RKAB) Tahunan;</br>
14. Laporan Bulanan Kualitas Air Limbah Pertambangan;</br>
15. Laporan Triwulan I/II/III/IV;</br>
16. Laporan Triwulan Statistik Kecelakaan Tambang dan Kejadian Berbahaya;</br>
17. Laporan Triwulan Statistik Penyakit Tenaga Kerja;</br>
18. Laporan Pelaksanaan Pemasangan Tanda Batas;</br>
19. Laporan Pemeliharaan Tanda Batas;</br>
20. Laporan Pelaksanaan Reklamasi;</br>
21. Bukti Pembayaran Iuran Tetap Tahun Terakhir;</br>
22. Bukti Pembayaran Pajak Daerah dan Retribusi Daerah Untuk Penjualan Bahan Galian;</br>
23. Bukti Penempatan Jaminan Reklamasi;</br>
24. Bukti Penempatan Jaminan Pascatambang;</br>
25. Persetujuan Penggunaan Kawasan Hutan (Apabila Wilayah yang akan Ditambang Masuk Dalam Kawasan Hutan)</br>
26. Laporan Pengambilan dan Penggunaan Mineral Bukan Logam, Mineral Bukan Logam Jenis Tertentu dan Batuan Kepada Pemerintah Kabupaten/Kota;</br>
27. Sertifikat CPI Sumberdaya dan Cadangan atau Surat Pernyataan tenaga Ahli yang Bertanggung Jawab Terhadap Perhitungan Sumberdaya dan Cadangan (Bermaterai)</br>
28. Dokumen Rencana Kerja dan Anggaran Biaya (RKAB) (Pdf);</br>"
            ],
            [
                "12",
                "Persetujuan Rencana Pascatambang",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup (Pkplh);</br>
4. Dokumen Study Kelayakan dan Persetujuan;</br>
5. Dokumen Rencana Kerja dan Anggaran Biaya (RKAB)  dan Persetujuan;</br>
6. Bukti Pembayaran Iuran Tetap;</br>
7. Dokumen Rencana Pascatambang (Pdf);</br>"
            ],
            [
                "13",
                "Persetujuan Rencana Reklamasi",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup (PKPLH);</br>
4. Dokumen Study Kelayakan dan Persetujuan;</br>
5. Dokumen Rencana Kerja dan Anggaran Biaya (RKAB) dan Persetujuan;</br>
6. Bukti Pembayaran Iuran Tetap;</br>
7. Dokumen Rencana Reklamasi (Pdf);</br>"
            ],
            [
                "14",
                "Persetujuan Studi Kelayakan (FS/ Feasibility Study)",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Persetujuan Laporan Akhir Eksplorasi;</br>
4. Bukti Bayar Iuran Tetap Tahun Terakhir;</br>
5. Sertifikat CPI Sumberdaya dan Cadangan atau Surat Pernyataan Tenaga Ahli yang Bertanggung Jawab Terhadap Perhitungan Sumberdaya dan Cadangan (Bermaterai)</br>
6. Persetujuan Dokumen Lingkungan Hidup;</br>
7. Dokumen FS (Pdf);</br>"
            ],
            [
                "15",
                "Persetujuan Studi Kelayakan Teknologi dan Ekonomi (FS/ Feasibility Study)",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Persetujuan Laporan Akhir Eksplorasi;</br>
4. Bukti Bayar Iuran Tetap Tahun Terakhir;</br>
5. Sertifikat CPI Sumberdaya dan Cadangan atau Surat Pernyataan Tenaga Ahli yang Bertanggung Jawab Terhadap Perhitungan Sumberdaya dan Cadangan (Bermaterai)</br>
6. Pengangkatan / Pengesahan KTT;</br>
7. Dokumen FS (Pdf);</br>"
            ],
            [
                "16",
                "Surat Angkut Asal Barang (SAAB)",
                "1. Surat Permohonan (Ttd Direktur Utama dan Cap);</br>
2. Surat Pernyataan Kebenaran Data (Ttd Direktur Utama dan Cap);</br>
3. Surat Kirim Barang;</br>
4. Draught Survey Report;</br>
5. COA / ROA;</br>
6. Bukti Setor Pajak Daerah;</br>
7. Surat Pernyataan Asal Barang;</br>
8. Surat Keabsahan Dokumen;</br>
9. Kontrak Jual Beli;</br>
10. SK IUP/SIPB;</br>
11. Persetujuan Dokumen Rencana Penambangan SIPB;</br>
12. Berita Acara Peninjauan Lapangan (Jika Ada Penugasan);</br>
13. Dokumen Rencana Penambangan dan Persetujuan;</br>
14. Persetujuan PKPLH;</br>
15. Laporan Pelaksanaan Kegiatan Penambangan;</br>
16. Laporan Pengelolaan dan Pemantauan Lingkungan;</br>
17. Laporan Akhir Produksi;</br>
18. Laporan Khusus * => Jika Ada Kejadian Atau Kondisi Tertentu Wajib Disampaikan.(Sesuai Permen Esdm No. 10 Th 2023 Pasal 16);</br>
19. Cantumkan pada Kolom Keterangan : Dokumen Rencana Penambangan SIPB Tahun ....., Produksi dan Penjualan :.......M³, Pajak Daerah yang Dibayar : Rp........;</br>"
            ]
        ];
        foreach ($daftarjudul as $judul) {
            DB::table('permitworks')->insert([
                'name_permit' => $judul[0] . "." . $judul[1],
                'desc_permit' => $judul[2],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
