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
        Schema::create('handaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('handak_no_persetujuan');
            $table->date('handak_tgl')->nullable();
            $table->string('handak_jenis_bahan')->nullable();
            $table->string('handak_kapasitas_gudang')->nullable();
            $table->date('handak_tgl_mulai')->nullable();
            $table->date('handak_tgl_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handaks');
    }
};
