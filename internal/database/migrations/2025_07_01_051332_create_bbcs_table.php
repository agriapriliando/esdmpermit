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
        Schema::create('bbcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('bbc_tangki_no_persetujuan')->nullable();
            $table->date('bbc_tgl')->nullable();
            $table->string('bbc_kapasitas_tangki')->nullable();
            $table->date('bbc_tgl_mulai')->nullable();
            $table->date('bbc_tgl_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bbcs');
    }
};
