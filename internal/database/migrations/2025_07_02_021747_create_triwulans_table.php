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
        Schema::create('triwulans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('triwulan_tahun', 4);
            $table->string('laporan_triwulan_i')->nullable();
            $table->string('laporan_triwulan_ii')->nullable();
            $table->string('laporan_triwulan_iii')->nullable();
            $table->string('laporan_triwulan_iv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triwulans');
    }
};
