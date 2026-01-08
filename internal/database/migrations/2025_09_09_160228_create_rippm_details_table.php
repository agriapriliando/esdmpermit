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
        Schema::create('rippm_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('rippm_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('rippm_tahun')->nullable();
            $table->string('rippm_pendidikan_rencana')->nullable();
            $table->string('rippm_pendidikan_realisasi')->nullable();
            $table->string('rippm_kesehatan_rencana')->nullable();
            $table->string('rippm_kesehatan_realisasi')->nullable();
            $table->string('rippm_kemandirian_rencana')->nullable();
            $table->string('rippm_kemandirian_realisasi')->nullable();
            $table->string('rippm_tenaga_kerja_rencana')->nullable();
            $table->string('rippm_tenaga_kerja_realisasi')->nullable();
            $table->string('rippm_sosbud_rencana')->nullable();
            $table->string('rippm_sosbud_realisasi')->nullable();
            $table->string('rippm_lingkungan_rencana')->nullable();
            $table->string('rippm_lingkungan_realisasi')->nullable();
            $table->string('rippm_lembaga_komunitas_rencana')->nullable();
            $table->string('rippm_lembaga_komunitas_realisasi')->nullable();
            $table->string('rippm_infrastruktur_rencana')->nullable();
            $table->string('rippm_infrastruktur_realisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rippm_details');
    }
};
