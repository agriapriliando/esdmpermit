# Buku Manual Pengguna – Fitur Profil Perusahaan
Dokumen ini ditujukan bagi pengguna aplikasi (staf/administrator) yang mengelola data profil perusahaan melalui antarmuka MinersDB. Tidak diperlukan pengetahuan teknis pemrograman untuk mengikuti panduan ini.

## 1. Prasyarat Penggunaan
1. **Masuk ke aplikasi** melalui halaman login (`/login`). Gunakan username dan password yang telah diberikan. Jika berhasil, Anda akan dibawa ke halaman daftar perusahaan.
2. **Pilih perusahaan** dari tabel daftar (`/home`). Klik nama perusahaan untuk membuka profilnya; pilihan ini juga mengaktifkan menu-menu lanjutan. Bila belum memilih perusahaan, aplikasi tidak mengizinkan akses ke halaman profil.

## 2. Membuka Halaman Profil
- Setelah memilih perusahaan, temukan menu **“Profil Perusahaan”** pada panel samping kiri dan klik untuk membuka detailnya.
- Anda juga bisa langsung mengetik alamat `/profile/{id}` di browser jika sudah mengetahui ID perusahaan, namun cara ini jarang dipakai pengguna umum.

## 3. Mengenal Tampilan Profil
1. **Header** – Menampilkan nama perusahaan dan tombol kembali ke daftar. Di sisi kanan ada tombol **Edit** (belum aktif saat pertama dibuka).
2. **Formulir detail** – Berisi kolom-kolom seperti alamat, komoditas, masa berlaku izin, kontak PIC, dan lain-lain. Default-nya kolom dalam mode baca.
3. **Tombol aksi** – Muncul saat mode edit aktif: **Simpan Perubahan** dan **Batal**.

## 4. Penjelasan Kolom Penting
Tabel berikut merangkum arti setiap kolom yang paling sering digunakan operator:

| Kolom | Deskripsi |
| --- | --- |
| `nama_pemegang_perizinan` | Nama pemegang izin (wajib diisi). |
| `kabupaten_kota`, `kecamatan`, `desa_kelurahan` | Lokasi administratif perizinan. |
| `luas_ha` | Luas wilayah izin (hektare). |
| `tahapan_iup` | Status tahapan IUP (eksplorasi/operasi produksi, dll.). |
| `komoditas` | Komoditas utama. |
| `nomor_induk_berusaha_nib` | NIB perusahaan. |
| `nomor_npwp`, `status_npwp` | Informasi NPWP. |
| `jenis_izin` | Jenis izin (IUP/SIPB/IPP/IUJP). Menentukan menu lanjutan yang tersedia. |
| `nomor_sk_izin`, `tgl_terbit_izin`, `tgl_berakhir_izin` | Data SK izin beserta masa berlaku. |
| `alamat_perusahaan_berdasarkan_sk_izin` | Alamat sesuai SK. |
| `nama_direktur_sesuai_sk_izin`, `dewan_direksi_bod` | Informasi direksi. |
| `modal_kerja` | Modal kerja yang tercantum. |
| `nama_pic`, `no_hp_pic`, `email_resmi_perusahaan` | Kontak penanggung jawab. |
| `nib_email_oss`, `nib_nomor_hp_oss` | Kontak OSS. |
| `keterangan`, `kontrak_kerja_sama`, `jenis_bidang_sub_bidang_usaha_jasa` | Catatan tambahan. |

Kolom-kolom di atas wajib diisi sesuai dokumen resmi perusahaan. Jika ada data tambahan (mis. kontrak kerja sama), masukkan pada kolom keterangan sesuai kebutuhan.

## 5. Cara Mengubah Data
1. Klik tombol **Edit** di pojok kanan kartu.
2. Field akan aktif dan bisa diubah. Pastikan format mengikuti petunjuk singkat di bawah field (contoh: tanggal menggunakan format `YYYY-MM-DD`, email harus valid).
3. Tekan **Simpan Perubahan** untuk menyimpan. Jika ada kesalahan, aplikasi akan menampilkan pesan merah di bawah field terkait.
4. Jika ingin membatalkan tanpa menyimpan, klik **Batal** sehingga data kembali ke kondisi semula.
5. Setelah berhasil, muncul notifikasi (toast) bahwa data berhasil diperbarui.

## 6. Menambah Perusahaan Baru
1. Pilih menu **Tambah Profil** (biasanya berada di daftar perusahaan).
2. Isi form kosong dengan data sesuai dokumen perusahaan.
3. Klik **Simpan**. Jika validasi terpenuhi, data tersimpan dan form akan kosong kembali untuk entri berikutnya.
4. Jika muncul kesalahan, ikuti pesan yang ditampilkan (misal panjang teks berlebih atau format email salah).

## 7. Tips Pengguna
- **Format tanggal**: Gunakan format `YYYY-MM-DD` (contoh: 2025-06-30). Sistem otomatis menyesuaikan ke format yang tepat saat menampilkan.
- **Perpindahan modul**: Setelah memilih perusahaan, Anda bisa langsung pindah ke modul lain (Iuran, RKAB, dsb.) tanpa memilih ulang. Namun bila ingin mengedit perusahaan lain, kembali ke daftar dan pilih perusahaan tersebut terlebih dahulu.
- **Pencatatan eksternal**: Karena belum ada riwayat perubahan otomatis, catat perubahan penting (misal perubahan direksi) di tempat lain atau gunakan ekspor data sebagai arsip berkala.

Panduan ini hanya membahas fitur profil. Untuk modul lain (Iuran, RKAB, RIPPM, dll.) akan tersedia buku manual terpisah.
