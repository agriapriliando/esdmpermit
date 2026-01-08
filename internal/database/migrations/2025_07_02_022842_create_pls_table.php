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
        Schema::create('pls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('persetujuan_lingkungan_nomor');
            $table->date('persetujuan_lingkungan_tgl')->nullable();
            $table->string('persetujuan_lingkungan_target_produksi')->nullable();
            $table->string('persetujuan_lingkungan_wilayah_izin')->nullable();
            $table->string('persetujuan_lingkungan_area_penunjang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pls');
    }
};
