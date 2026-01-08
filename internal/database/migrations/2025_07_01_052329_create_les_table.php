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
        Schema::create('les', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('le_no_persetujuan');
            $table->date('le_tgl_persetujuan')->nullable();
            $table->string('le_sd_m3_tereka')->nullable();
            $table->string('le_sd_m3_tertunjuk')->nullable();
            $table->string('le_sd_m3_terukur')->nullable();
            $table->string('le_sd_mt_tereka')->nullable();
            $table->string('le_sd_mt_tertunjuk')->nullable();
            $table->string('le_sd_mt_terukur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('les');
    }
};
