# Buku Manual Pengguna MinersDB

Panduan ini ditulis khusus untuk pengguna operasional agar dapat memanfaatkan seluruh fitur aplikasi MinersDB. Setiap bagian menjelaskan tujuan menu, langkah penggunaan, dan daftar kolom yang harus diisi dengan nama yang mudah dipahami.

---

## 1. Cara Masuk / Login

1. Login aplikasi miners.kalteng.go.id pada peramban.
2. Pilih MinersDB di Daftar Menu
3. Login **Username** dan **Password** menggunakan akun Miners.
4. Centang **Ingat Saya** bila ingin tetap masuk selama beberapa hari.
5. Tekan tombol **Login**. Bila gagal, periksa pesan kesalahan yang muncul.

---

## 2. Dasbor & Navigasi Utama

-   Setelah login Anda akan melihat **Daftar Perusahaan**.
-   Panel kiri berisi menu yang berbeda tergantung apakah Anda sudah memilih perusahaan dan jenis izinnya.
-   Pilih perusahaan terlebih dahulu agar menu lanjutan (Profil, Iuran, RKAB, dst.) aktif.

---

## 3. Daftar Perusahaan

### Tujuan

Menemukan dan memilih perusahaan untuk diedit datanya.

### Langkah

1. Gunakan kotak pencarian untuk mencari nama atau NIB.
2. Gunakan filter **Kabupaten/Kota**, **Komoditas**, **Jenis Izin**, serta jumlah data per halaman.
3. Klik nama perusahaan untuk membuka profil.
4. Tombol **Reset** mengembalikan semua filter ke kondisi awal.
5. Gunakan tombol salin untuk menyalin isi tabel ke clipboard bila diperlukan.

### Kolom pada Tabel

-   **Nama Pemegang Perizinan**
-   **NIB**
-   **Kabupaten/Kota**
-   **Komoditas**
-   **Jenis Izin**
-   **Tahapan IUP**
-   **Tanggal Terbit Izin**
-   **Tanggal Berakhir Izin**

---

## 4. Ekspor Data Profil

### Tujuan

Mengunduh data perusahaan dan seluruh lampiran perizinan ke dalam file Excel.

### Langkah

1. Buka menu **Export Data Profil**.
2. Pilih kolom yang ingin dimasukkan (mis. Profil, Iuran, RKAB).
3. Pilih perusahaan yang ingin diekspor; gunakan tombol **Pilih Semua** bila diperlukan.
4. Tekan **Export ke Excel** untuk mengunduh file.

### Tips

-   Kolom yang dicentang menentukan isi Excel. Pastikan hanya memilih data yang diperlukan agar file lebih ringkas.

---

## 5. Profil Perusahaan

### Tujuan

Menyimpan informasi umum perusahaan (tabel utama MinersDB).

### Mengedit Profil

1. Buka menu **Profil Perusahaan** setelah memilih perusahaan.
2. Tekan tombol **Edit**.
3. Ubah data yang diperlukan.
4. Tekan **Simpan Perubahan** atau **Batal** bila tidak jadi mengubah.

### Menambah Profil Baru

1. Dari daftar perusahaan, pilih **Tambah Profil**.
2. Isi seluruh kolom.
3. Tekan **Simpan**.

### Kolom yang Harus Diisi

| Kelompok    | Nama Kolom                                                                                                                                     |
| ----------- | ---------------------------------------------------------------------------------------------------------------------------------------------- |
| Identitas   | Nama Pemegang Perizinan, Jenis Izin, Nomor SK Izin, Tanggal Terbit Izin, Tanggal Berakhir Izin, Tahapan IUP, Komoditas, NIB, NPWP, Status NPWP |
| Lokasi      | Kabupaten/Kota, Kecamatan, Desa/Kelurahan, Alamat Perusahaan                                                                                   |
| Pimpinan    | Nama Direktur Sesuai SK, Dewan Direksi/BOD                                                                                                     |
| Operasional | Luas (Ha), Modal Kerja, Kontrak Kerja Sama, Jenis Bidang/Sub Bidang Usaha Jasa                                                                 |
| Kontak      | Nama PIC, Nomor HP PIC, Email Resmi, Email OSS, Nomor HP OSS                                                                                   |
| Catatan     | Keterangan Tambahan                                                                                                                            |

**Format tanggal**: gunakan `YYYY-MM-DD` (contoh 2025-06-30).  
**Format email**: pastikan menggunakan format email valid.

---

## 6. Modul Perizinan & Dokumen Teknis

Setiap modul memiliki pola yang sama:

1. Pilih perusahaan terlebih dahulu.
2. Buka menu modul (mis. Iuran, IUI, RKAB).
3. Gunakan tombol **Tambah** untuk entri baru.
4. Klik **Edit** pada baris yang ingin diperbarui.
5. Gunakan **Simpan** untuk menegaskan perubahan dan **Batal** untuk membatalkan.
6. Panel **Unggah Dokumen** tersedia di bagian bawah (isi jenis dokumen, pilih file, klik Simpan).

Berikut daftar modul beserta kolom isian:

### 6.1 Iuran Tetap Tahunan

| Nama Kolom                          |
| ----------------------------------- |
| Nominal Iuran Tetap per Tahun       |
| Tanggal Bayar Iuran Tetap per Tahun |

### 6.2 Izin Usaha Industri (IUI)

| Nama Kolom                   |
| ---------------------------- |
| Nomor Izin IUI               |
| Tanggal Izin IUI             |
| Status Permodalan (PMDN/PMA) |
| Kontrak Kerja Sama           |

### 6.3 Kepala Teknik Tambang (KTT)

| Nama Kolom                 |
| -------------------------- |
| Nomor Pengesahan KTT       |
| Tanggal Pengesahan KTT     |
| Nama Kepala Teknik Tambang |

### 6.4 Kartu Izin Meledak (KIM)

| Nama Kolom              |
| ----------------------- |
| Nomor Persetujuan KIM   |
| Tanggal Persetujuan KIM |
| Nama Juru Ledak         |
| Tanggal Mulai Berlaku   |
| Tanggal Selesai Berlaku |

### 6.5 Gudang Bahan Peledak (Handak)

| Nama Kolom                      |
| ------------------------------- |
| Nomor Persetujuan Gudang Handak |
| Tanggal Persetujuan             |
| Jenis Bahan                     |
| Kapasitas Gudang                |
| Tanggal Mulai Berlaku           |
| Tanggal Selesai Berlaku         |

### 6.6 Tangki BBC

| Nama Kolom                   |
| ---------------------------- |
| Nomor Persetujuan Tangki BBC |
| Tanggal Persetujuan          |
| Kapasitas Tangki             |
| Tanggal Mulai Berlaku        |
| Tanggal Selesai Berlaku      |

### 6.7 Laporan Eksplorasi

| Nama Kolom                                      |
| ----------------------------------------------- |
| Nomor Persetujuan                               |
| Tanggal Persetujuan                             |
| Sumber Daya Volume (Tereka, Tertunjuk, Terukur) |
| Sumber Daya Massa (Tereka, Tertunjuk, Terukur)  |

### 6.8 Pelabuhan

| Nama Kolom                    |
| ----------------------------- |
| Nomor Persetujuan Pelabuhan   |
| Tanggal Persetujuan           |
| Status Fasilitas (TUKS/Terum) |

### 6.9 Persetujuan Lingkungan

| Nama Kolom                   |
| ---------------------------- |
| Nomor Persetujuan Lingkungan |
| Tanggal Persetujuan          |
| Target Produksi              |
| Wilayah Izin                 |
| Area Penunjang               |

### 6.10 Project Area

| Nama Kolom              |
| ----------------------- |
| Nomor Project Area      |
| Tanggal Project Area    |
| Penggunaan Project Area |
| Luas Project Area       |
| Keterangan Project Area |

### 6.11 Rencana Pascatambang (RPT)

| Nama Kolom               |
| ------------------------ |
| Nomor Persetujuan RPT    |
| Tanggal Persetujuan      |
| Nominal yang Ditetapkan  |
| Nominal yang Ditempatkan |
| Tahun Pembayaran         |

### 6.12 Rencana Reklamasi (RR)

| Nama Kolom               |
| ------------------------ |
| Nomor Persetujuan RR     |
| Tanggal Persetujuan      |
| Tahun Pelaksanaan        |
| Nominal yang Ditetapkan  |
| Nominal yang Ditempatkan |

### 6.13 Studi Kelayakan

| Nama Kolom                                      |
| ----------------------------------------------- |
| Nomor Persetujuan Studi Kelayakan               |
| Tanggal Persetujuan                             |
| Sumber Daya Volume (Tereka, Tertunjuk, Terukur) |
| Sumber Daya Massa (Tereka, Tertunjuk, Terukur)  |
| Luas Sumber Daya                                |
| Tenaga Ahli Sumber Daya                         |
| Cadangan Volume (Terkira, Terbukti)             |
| Cadangan Massa (Terkira, Terbukti)              |
| Luas Cadangan                                   |
| Tenaga Ahli Cadangan                            |
| Target Produksi Volume                          |
| Target Produksi Massa                           |

### 6.14 Tanda Batas

| Nama Kolom                       |
| -------------------------------- |
| Nomor SK Tanda Batas             |
| Tanggal SK Tanda Batas           |
| Laporan Pemeliharaan Tanda Batas |

### 6.15 Dokumen Pelaporan Umum

| Nama Kolom                 |
| -------------------------- |
| Jenis Dokumen              |
| Judul Dokumen              |
| Catatan Dokumen (opsional) |
| File Dokumen               |

### 6.16 Surat Menyurat

| Nama Kolom                 |
| -------------------------- |
| Jenis Surat (Masuk/Keluar) |
| Judul Surat                |
| File Surat                 |

---

## 7. Laporan Produksi

### 7.1 Laporan Bulanan

Digunakan untuk mencatat rencana dan realisasi produksi serta penjualan tiap bulan.

| Nama Kolom                               |
| ---------------------------------------- |
| Tahun Laporan                            |
| Rencana Produksi Utama Bulan 1–12        |
| Rencana Produksi Sampingan Bulan 1–12    |
| Realisasi Produksi Utama Bulan 1–12      |
| Realisasi Produksi Sampingan Bulan 1–12  |
| Realisasi Penjualan Utama Bulan 1–12     |
| Realisasi Penjualan Sampingan Bulan 1–12 |
| Keterangan Laporan (opsional)            |

### 7.2 Laporan Triwulan

| Nama Kolom           |
| -------------------- |
| Tahun Laporan        |
| Laporan Triwulan I   |
| Laporan Triwulan II  |
| Laporan Triwulan III |
| Laporan Triwulan IV  |

---

## 8. Rencana Induk Pengembangan dan Pemberdayaan Masyarakat (RIPPM)

### 8.1 Header RIPPM

| Nama Kolom              |
| ----------------------- |
| Nomor Persetujuan RIPPM |
| Tanggal Persetujuan     |
| Keterangan RIPPM        |

### 8.2 Detail RIPPM

Untuk setiap tahun, isi rencana dan realisasi pada bidang berikut:

-   Pendidikan
-   Kesehatan
-   Kemandirian
-   Tenaga Kerja
-   Sosial Budaya
-   Lingkungan
-   Lembaga Komunitas
-   Infrastruktur

Setiap bidang memiliki nilai **Rencana** dan **Realisasi** per tahun.

---

## 9. Rencana Kerja dan Anggaran Biaya (RKAB)

### 9.1 RKAB Operasi Produksi

Mencatat rencana tiga tahunan untuk sumber daya, cadangan, produksi, pajak, dan tenaga kerja.

| Kelompok                 | Nama Kolom                                                         |
| ------------------------ | ------------------------------------------------------------------ |
| Identitas                | Nomor Persetujuan RKAB, Tanggal Persetujuan                        |
| Sumber Daya Tahun I      | Volume Tereka/Tertunjuk/Terukur, Massa Tereka/Tertunjuk/Terukur    |
| Sumber Daya Tahun II     | Volume Tereka/Tertunjuk/Terukur, Massa Tereka/Tertunjuk/Terukur    |
| Sumber Daya Tahun III    | Volume Tereka/Tertunjuk/Terukur, Massa Tereka/Tertunjuk/Terukur    |
| Cadangan                 | Terkira/Terbukti Tahun I–III                                       |
| Produksi Tahun I–III     | Target & Realisasi untuk Produk Utama dan Sampingan (Volume/Massa) |
| Pajak Tahun I–III        | Pajak Daerah, Pajak Opse                                           |
| Tenaga Kerja Tahun I–III | Lokal, Non Lokal, Tenaga Kerja Asing                               |
| Tenaga Ahli              | Tenaga Ahli Sumber Daya, Tenaga Ahli Cadangan                      |

### 9.2 RKAB Peralatan

| Nama Kolom               |
| ------------------------ |
| Tahun Pemakaian          |
| Jenis Peralatan          |
| Merk Peralatan           |
| Jumlah Peralatan         |
| Nomor Plat               |
| Status Milik Sendiri     |
| Status Sewa              |
| Pasokan BBM dari Kalteng |
| Pasokan BBM Non Kalteng  |
| Rencana Pemakaian BBM    |
| Keterangan Peralatan     |

---

## 10. Perizinan SIPB

### 10.1 Rencana Penambangan SIPB (SIPBRP)

| Nama Kolom                                      |
| ----------------------------------------------- |
| Nomor Persetujuan                               |
| Tanggal Persetujuan                             |
| Sumber Daya Volume (Tereka, Tertunjuk, Terukur) |
| Sumber Daya Massa (Tereka, Tertunjuk, Terukur)  |
| Luas Sumber Daya                                |
| Tenaga Ahli Sumber Daya                         |
| Cadangan Volume (Terkira, Terbukti)             |
| Cadangan Massa (Terkira, Terbukti)              |
| Luas Cadangan                                   |
| Tenaga Ahli Cadangan                            |
| Target Produksi Volume                          |
| Target Produksi Massa                           |

### 10.2 Rencana Teknis SIPB (SIPB RTP)

Kolomnya sama seperti SIPBRP namun difokuskan pada rencana teknis.

---

## 11. Pelaporan & Surat

-   **Pelaporan**: Unggah berbagai laporan (format PDF/JPG). Gunakan kolom **Jenis Dokumen** dan **Judul Dokumen** agar mudah dicari.
-   **Surat Menyurat**: Klasifikasikan sebagai **Surat Masuk** atau **Surat Keluar**, beri judul yang mudah dikenali, lalu unggah file.

---

## 12. Cetak Profil

Menu **Cetak Profil** menyediakan tampilan siap cetak yang memuat ringkasan data perusahaan. Gunakan saat perlu mencetak profil untuk rapat atau arsip fisik.

---

## 13. Tips Umum

1. **Selalu pilih perusahaan sebelum membuka modul apa pun** agar data tersimpan ke perusahaan yang benar.
2. **Gunakan format tanggal standar** `YYYY-MM-DD`.
3. **Periksa ukuran file** sebelum unggah (10 MB atau 150 MB untuk modul Pelaporan).
4. **Catat perubahan penting** (misalnya pergantian direktur) secara berkala dan pertimbangkan mengekspor data sebagai arsip.
5. **Gunakan fitur pencarian/filter** untuk mempercepat pencarian data lama.

Dengan mengikuti panduan ini, seluruh fitur MinersDB dapat digunakan secara optimal oleh pengguna bisnis maupun staf administrasi.
