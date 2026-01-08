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
        Schema::create('rkabops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('rkabop_no_persetujuan');
            $table->date('rkabop_tgl_persetujuan')->nullable();

            // Sumber Daya Tahun I
            $table->string('rkabop_sd_thn_i_m3_tereka', 30)->nullable();
            $table->string('rkabop_sd_thn_i_m3_tertunjuk', 30)->nullable();
            $table->string('rkabop_sd_thn_i_m3_terukur', 30)->nullable();
            $table->string('rkabop_sd_thn_i_mt_tereka', 30)->nullable();
            $table->string('rkabop_sd_thn_i_mt_tertunjuk', 30)->nullable();
            $table->string('rkabop_sd_thn_i_mt_terukur', 30)->nullable();

            // Sumber Daya Tahun II
            $table->string('rkabop_sd_thn_ii_m3_tereka', 30)->nullable();
            $table->string('rkabop_sd_thn_ii_m3_tertunjuk', 30)->nullable();
            $table->string('rkabop_sd_thn_ii_m3_terukur', 30)->nullable();
            $table->string('rkabop_sd_thn_ii_mt_tereka', 30)->nullable();
            $table->string('rkabop_sd_thn_ii_mt_tertunjuk', 30)->nullable();
            $table->string('rkabop_sd_thn_ii_mt_terukur', 30)->nullable();

            // Sumber Daya Tahun III
            $table->string('rkabop_sd_thn_iii_m3_tereka', 30)->nullable();
            $table->string('rkabop_sd_thn_iii_m3_tertunjuk', 30)->nullable();
            $table->string('rkabop_sd_thn_iii_m3_terukur', 30)->nullable();
            $table->string('rkabop_sd_thn_iii_mt_tereka', 30)->nullable();
            $table->string('rkabop_sd_thn_iii_mt_tertunjuk', 30)->nullable();
            $table->string('rkabop_sd_thn_iii_mt_terukur', 30)->nullable();

            // Tenaga Ahli Sumber Daya
            $table->string('rkabop_sd_tenaga_ahli', 100)->nullable();

            // Cadangan
            $table->string('rkabop_cadangan_thn_i_terkira', 30)->nullable();
            $table->string('rkabop_cadangan_thn_i_terbukti', 30)->nullable();
            $table->string('rkabop_cadangan_thn_ii_terkira', 30)->nullable();
            $table->string('rkabop_cadangan_thn_ii_terbukti', 30)->nullable();
            $table->string('rkabop_cadangan_thn_iii_terkira', 30)->nullable();
            $table->string('rkabop_cadangan_thn_iii_terbukti', 30)->nullable();

            // Tenaga Ahli (Cadangan) - di list ada dua, biasanya sama, tapi tetap dibuat satu kolom
            $table->string('rkabop_cadangan_tenaga_ahli', 100)->nullable();

            // Produksi Tahun I
            $table->string('rkabop_prod_thn_i_target_m3_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_i_target_m3_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_i_realisasi_m3_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_i_realisasi_m3_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_i_target_mt_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_i_target_my_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_i_realisasi_mt_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_i_realisasi_mt_sampingan', 30)->nullable();

            // Produksi Tahun II
            $table->string('rkabop_prod_thn_ii_target_m3_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_ii_target_m3_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_ii_realisasi_m3_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_ii_realisasi_m3_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_ii_target_mt_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_ii_target_my_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_ii_realisasi_mt_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_ii_realisasi_mt_sampingan', 30)->nullable();

            // Produksi Tahun III
            $table->string('rkabop_prod_thn_iii_target_m3_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_iii_target_m3_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_iii_realisasi_m3_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_iii_realisasi_m3_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_iii_target_mt_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_iii_target_my_sampingan', 30)->nullable();
            $table->string('rkabop_prod_thn_iii_realisasi_mt_utama', 30)->nullable();
            $table->string('rkabop_prod_thn_iii_realisasi_mt_sampingan', 30)->nullable();

            // Pajak
            $table->string('rkabop_pajak_thn_i_daerah', 30)->nullable();
            $table->string('rkabop_pajak_thn_i_opsen', 30)->nullable();
            $table->string('rkabop_pajak_thn_ii_daerah', 30)->nullable();
            $table->string('rkabop_pajak_thn_ii_opsen', 30)->nullable();
            $table->string('rkabop_pajak_thn_iii_daerah', 30)->nullable();
            $table->string('rkabop_pajak_thn_iii_opsen', 30)->nullable();

            // Tenaga Kerja Tahun I
            $table->string('rkabop_tenaga_kerja_thn_i_lokal', 30)->nullable();
            $table->string('rkabop_tenaga_kerja_thn_i_non_lokal', 30)->nullable();
            $table->string('rkabop_tenaga_kerja_thn_i_tka', 30)->nullable();

            // Tenaga Kerja Tahun II
            $table->string('rkabop_tenaga_kerja_thn_ii_lokal', 30)->nullable();
            $table->string('rkabop_tenaga_kerja_thn_ii_non_lokal', 30)->nullable();
            $table->string('rkabop_tenaga_kerja_thn_ii_tka', 30)->nullable();

            // Tenaga Kerja Tahun III
            $table->string('rkabop_tenaga_kerja_thn_iii_lokal', 30)->nullable();
            $table->string('rkabop_tenaga_kerja_thn_iii_non_lokal', 30)->nullable();
            $table->string('rkabop_tenaga_kerja_thn_iii_tka', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rkabops');
    }
};
