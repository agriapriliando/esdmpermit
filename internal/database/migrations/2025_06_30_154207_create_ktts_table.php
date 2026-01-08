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
        Schema::create('ktts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('ktt_no_pengesahan')->nullable();
            $table->date('ktt_tgl_pengesahan')->nullable();
            $table->string('nama_ktt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktts');
    }
};
