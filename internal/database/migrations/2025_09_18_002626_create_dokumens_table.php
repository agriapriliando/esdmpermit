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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('model_dokumen');                 // contoh: iuran,iui, dsb
            $table->string('jenis_dokumen')->nullable();     // contoh: KTP, NPWP, dsb
            $table->string('judul_dokumen')->nullable();
            $table->text('ket_dokumen')->nullable();
            $table->string('link_dokumen');                  // path atau URL file
            $table->bigInteger('size_dokumen')->nullable();  // ukuran file (byte)
            $table->string('ext_dokumen', 10)->nullable();   // pdf, jpg, png, dll
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
