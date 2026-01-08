<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemegang_perizinan');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->string('desa_kelurahan');
            $table->string('luas_ha', 12)->nullable();
            $table->string('tahapan_iup', 100)->nullable();
            $table->string('komoditas', 100)->nullable();
            $table->string('nomor_induk_berusaha_nib', 20)->nullable();
            $table->string('nomor_npwp', 50)->nullable();
            $table->string('status_npwp', 20)->nullable();
            $table->string('jenis_izin', 6)->nullable();
            $table->string('nomor_sk_izin', 100)->nullable();
            $table->date('tgl_terbit_izin')->nullable();
            $table->date('tgl_berakhir_izin')->nullable();
            $table->text('alamat_perusahaan_berdasarkan_sk_izin')->nullable();
            $table->string('nama_direktur_sesuai_sk_izin')->nullable();
            $table->text('dewan_direksi_bod')->nullable();
            $table->string('modal_kerja', 20)->nullable();
            $table->string('nama_pic', 50)->nullable();
            $table->string('no_hp_pic', 50)->nullable();
            $table->string('email_resmi_perusahaan', 120)->nullable();
            $table->string('nib_email_oss', 120)->nullable();
            $table->string('nib_nomor_hp_oss', 120)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('kontrak_kerja_sama')->nullable();
            $table->text('jenis_bidang_sub_bidang_usaha_jasa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
