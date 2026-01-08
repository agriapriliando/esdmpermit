# Spesifikasi Teknis MinersDB

Dokumen ini merangkum aspek teknis utama aplikasi MinersDB untuk tim pengembang/devops (Laravel 12, PHP 8.2, Livewire 3).

## 1. Ringkasan Arsitektur

-   **Framework**: Laravel 12, Livewire 3.6, Vite/Tailwind 4 (beta), Bootstrap template.
-   **Pola**: Server-rendered dengan Livewire sebagai pengendali UI; tidak ada `routes/api.php`. Komponen Livewire memanggil model Eloquent langsung (tanpa service/repository layer).
-   **State**: `session()` menyimpan token API eksternal (`api_token`), data pengguna, dan `id_perusahaan` terpilih; cookie dipakai untuk “ingat saya”.
-   **Dokumen**: Upload via trait `WithDokumen`, penyimpanan ke disk default (`storage/app`) dengan batas 10MB (umum) dan 150MB (pelaporan).
-   **Ekspor**: Maatwebsite/Excel, kelas `ProfilesExport` dengan eager load dinamis sesuai pilihan user.

## 2. Routing & Middleware

-   **File rute**: `routes/web.php` (saja). Semua endpoint HTTP ada di sini.
-   **Autentikasi eksternal**: `AuthApiController` login ke `https://miners.kalteng.go.id/api/login` (hard-coded, tanpa env).
-   **Middleware**:
    -   `CekApiAuth`: Wajibkan token di session/cookie; jika tidak ada redirect ke login.
    -   `CekIdPerusahaan`: Wajibkan `id_perusahaan` di session untuk modul teknis; bila tidak ada redirect ke `/home`.
-   **Rute utama** (GET kecuali disebutkan):
    -   `/login` (GET/POST), `/logout` (POST).
    -   `/home` daftar perusahaan (Livewire `DaftarPerusahaan`), bebas dari `CekIdPerusahaan`.
    -   `/profiles/view`, `/profiles/export` (export UI & view).
    -   Profil & modul teknis: `/profile/create`, `/profile/{id}`, `/profile/{id}/cetak`, `/iuran`, `/iui`, `/ktt`, `/kim`, `/handak`, `/bbc`, `/le`, `/pelabuhan`, `/pl`, `/pa`, `/rpt`, `/rr`, `/stk`, `/tb`, `/reportmonth`, `/triwulan`, `/surat`, `/rippm`, `/rippmdetail/{id}`, `/rkabop`, `/rkabopperalatan/{id}`, `/sipbrp`, `/sipbrtp`, `/pelaporan`.

## 3. Komponen & Modul

-   **Controllers**: `AuthApiController` (login/logout eksternal), `EprofileController` (view export; tidak dipakai di rute).
-   **Livewire utama**:
    -   **DaftarPerusahaan**: filter & pagination, hapus perusahaan + dokumen terkait.
    -   **Profile/ProfileAdd**: CRUD profil master; set `id_perusahaan` & `nama_pemegang_perizinan` ke session.
    -   **Dokumen teknis per modul**: Iuran, IUI, KTT, KIM, Handak, BBC, LE, Pelabuhan, PL, PA, RPT, RR, STK, TB.
    -   **Laporan**: Reportmonth (12 bulan), Triwulan (4 kuartal), Pelaporan umum (upload-only), Surat (upload-only).
    -   **RIPPM**: header + detail per tahun.
    -   **RKAB**: RKAB OP (multi-field 3 tahun) + RKAB Peralatan (per RKAB ID).
    -   **SIPB**: SIPBRP (rencana penambangan), SIPBRTP (rencana teknis).
    -   **ExportProfiles**: UI export + mapping kolom.
    -   **CetakProfil**: layout cetak statis (placeholder).
-   **Trait**: `WithDokumen` (upload, download inline PDF, delete, pagination reset).
-   **Exports**: `ProfilesExport` (FromCollection, WithHeadings, WithColumnFormatting).

## 4. Model & Skema Data (intisari)

-   **profiles**: master perusahaan (lokasi, izin, direktur, PIC, kontak, komoditas, tahapan IUP).
-   **Per modul** (semua FK `profile_id` cascade): `iurans`, `iuis`, `ktts`, `kims`, `handaks`, `bbcs`, `les`, `pelabuhans`, `pls`, `pas`, `tbs`, `rpts`, `rrs`, `stks`, `reportmonths`, `triwulans`, `rippms`, `rippm_details`, `rkabops`, `rkabop_peralatans`, `sipbrps`, `sipbrtps`.
-   **dokumens**: `profile_id`, `model_dokumen`, `jenis_dokumen`, `judul_dokumen`, `link_dokumen`, `size_dokumen`, `ext_dokumen`.
-   **Relasi utama di `Profile`**: hasMany ke semua modul + helper `latest*` (untuk export) `app/Models/Profile.php`.
-   **Nested**: `Rippm` hasMany `details`; `Rkabop` hasMany `peralatans`.
-   **Cast tanggal**: Beberapa model cast field tanggal (mis. Iuran, Rippm, Sipbrp/tp, Pl, dll.) untuk serialisasi.

## 5. Autentikasi & Otorisasi

-   **Login**: HTTP client ke API eksternal; token dan user disimpan di session + cookie (ingat saya).
-   **Session keys**: `api_token`, `user`, `id_perusahaan`, `nama_pemegang_perizinan`.
-   **Guard/Policy**: Tidak ada guard/policy Laravel. Proteksi mengandalkan middleware dan sesi. Akses UI disembunyikan berdasar `session('user')` dan `session('id_perusahaan')`.

## 6. Penyimpanan & Upload

-   **Disk**: Default Laravel (local). `WithDokumen::saveDokumen()` menyimpan `dokumens/{id_perusahaan}`; download membaca `storage_path('app/private/...')` (perlu konsistensi disk).
-   **Batas ukuran**: 10MB umum, 150MB untuk model `pelaporan` (dalam trait).
-   **Ekstensi**: Tidak dibatasi di kode, namun validasi Livewire hanya memeriksa `file` dan `max`.

## 7. Frontend

-   **Layout**: `components.layouts.app` (Bootstrap + tema), slot Livewire, menu dinamis IUP/SIPB; `components.layouts.cetak` untuk cetak.
-   **Assets**: Vite dengan Tailwind 4 (`@theme`), vendor CSS/JS statis di `public/assets`.
-   **Interaksi**: Livewire + Alpine (contoh toggle password, copy table). Custom pagination Bootstrap di `resources/views/custom-pagination.blade.php`.

## 8. Skrip & Tooling

-   **Composer scripts**:
    -   `composer run dev`: concurrently jalankan `php artisan serve`, `queue:listen`, `pail`, `npm run dev`.
    -   `composer run test`: `config:clear` lalu `php artisan test`.
-   **Node scripts**: `npm run dev`, `npm run build` (Vite).

## 9. Lingkungan & Konfigurasi

-   **.env**: MySQL (`db_minersdb`), `QUEUE_CONNECTION=database`, `CACHE_STORE=database`, `FILESYSTEM_DISK=local`, `APP_DEBUG=true`, URL default `http://localhost`.
-   **Livewire config**: Layout default `components.layouts.app`, upload max 150000 KB (global), pagination theme `tailwind` (diganti manual di view), navigate progress bar aktif.
-   **Endpoint eksternal**: Hard-coded di `AuthApiController` (perlu variabel env untuk fleksibilitas).

## 10. Risiko & Peningkatan

-   **Audit/riwayat**: Tidak ada tracking perubahan atau versi dokumen.
-   **Validasi & DRY**: Banyak aturan serupa di komponen Livewire; bisa dipusatkan (traits/helper).
-   **Testing**: Belum ada test otomatis; perlu feature test untuk login, middleware, Livewire form kompleks.
-   **Ekspor**: Heading memakai kolom “raw” (eng), bisa ditambahkan label human-readable jika diperlukan user akhir.

## 11. Langkah Operasional (ringkas)

1. `composer install` & `npm install`.
2. Salin `.env`, set DB, jalankan `php artisan key:generate`.
3. `php artisan migrate --seed`.
4. (Opsional) `php artisan storage:link`.
5. Jalankan `composer run dev` untuk server+queue+vite terpadu.
6. Akses `APP_URL`, login via kredensial API eksternal.

## 12. Struktur File Penting

-   **Rute**: `routes/web.php`
-   **Middleware**: `app/Http/Middleware/CekApiAuth.php`, `CekIdPerusahaan.php`
-   **Auth**: `app/Http/Controllers/AuthApiController.php`
-   **Livewire**: `app/Livewire/**` (DaftarPerusahaan, Profile\*, modul-modul perizinan, laporan, export)
-   **Model**: `app/Models/**` (Profil + modul + Dokumen)
-   **Trait Upload**: `app/Traits/WithDokumen.php`
-   **Ekspor**: `app/Exports/ProfilesExport.php`
-   **View/Layout**: `resources/views/components/layouts/app.blade.php`, `cetak.blade.php`
-   **Template Livewire**: `resources/views/livewire/**`
-   **Migrasi**: `database/migrations/**`
-   **Seeder**: `database/seeders/DatabaseSeeder.php` + seeder modul
-   **Konfigurasi**: `.env`, `config/livewire.php`, `composer.json`, `package.json`

## 13. Catatan Deploy

-   Pastikan ekstensi PHP: `mbstring`, `openssl`, `pdo_mysql`, `fileinfo`, `gd` (untuk Excel eksport tergantung php-office).
-   Sesuaikan `APP_URL`, `SESSION_DOMAIN`, dan CORS (jika diperlukan) untuk domain produksi.
-   SSL: Login API menggunakan `Http::withoutVerifying()`; di produksi sebaiknya gunakan sertifikat valid dan hapus opsi ini.
