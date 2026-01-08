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
        Schema::create('sipbrps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('sipbrp_no_persetujuan');
            $table->date('sipbrp_tgl_persetujuan')->nullable();
            $table->string('sipbrp_sd_m3_tereka')->nullable();
            $table->string('sipbrp_sd_m3_tertunjuk')->nullable();
            $table->string('sipbrp_sd_m3_terukur')->nullable();
            $table->string('sipbrp_sd_mt_tereka')->nullable();
            $table->string('sipbrp_sd_mt_tertunjuk')->nullable();
            $table->string('sipbrp_sd_mt_terukur')->nullable();
            $table->string('sipbrp_luas_sumber_daya')->nullable();
            $table->string('sipbrp_sd_tenaga_ahli')->nullable();
            $table->string('sipbrp_cadang_m3_terkira')->nullable();
            $table->string('sipbrp_cadang_m3_terbukti')->nullable();
            $table->string('sipbrp_cadang_mt_terkira')->nullable();
            $table->string('sipbrp_cadang_mt_terbukti')->nullable();
            $table->string('sipbrp_luas_cadangan')->nullable();
            $table->string('sipbrp_cadang_tenaga_ahli')->nullable();
            $table->string('sipbrp_target_produksi_m3')->nullable();
            $table->string('sipbrp_target_produksi_mt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sipbrps');
    }
};
