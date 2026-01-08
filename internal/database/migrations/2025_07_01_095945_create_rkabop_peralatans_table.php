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
        Schema::create('rkabop_peralatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('rkabop_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('rkab_peralatan_pilih_tahun', 4);
            $table->string('rkab_peralatan_jenis', 50)->nullable();
            $table->string('rkab_peralatan_merk')->nullable();
            $table->string('rkab_peralatan_jumlah', 30)->nullable();
            $table->string('rkab_peralatan_no_plat', 100)->nullable();
            $table->string('rkab_peralatan_status_milik_sendiri')->nullable();
            $table->string('rkab_peralatan_status_sewa')->nullable();
            $table->string('rkab_peralatan_bbm_asal_kalteng', 120)->nullable();
            $table->string('rkab_peralatan_bbm_non_kalteng', 120)->nullable();
            $table->string('rkab_peralatan_rencana_pakai_bbm')->nullable();
            $table->text('rkab_peralatan_keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rkabop_peralatans');
    }
};
