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
        Schema::create('reportmonths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('tahun_laporan', 4);
            // Kolom laporan per bulan (1-12)
            for ($i = 1; $i <= 12; $i++) {
                $table->string("laporan_{$i}_rencana_produksi_utama", 15)->nullable();
                $table->string("laporan_{$i}_rencana_produksi_sampingan", 15)->nullable();
                $table->string("laporan_{$i}_realisasi_produksi_utama", 15)->nullable();
                $table->string("laporan_{$i}_realisasi_produksi_sampingan", 15)->nullable();
                $table->string("laporan_{$i}_realisasi_penjualan_utama", 15)->nullable();
                $table->string("laporan_{$i}_realisasi_penjualan_sampingan", 15)->nullable();
            }

            $table->string('laporan_keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportmonths');
    }
};
