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
        Schema::create('rpts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('rpt_no_persetujuan');
            $table->date('rpt_tgl_persetujuan')->nullable();
            $table->string('rpt_nominal_yang_ditetapkan', 20, 2)->nullable();
            $table->string('rpt_nominal_yang_ditempatkan', 20, 2)->nullable();
            $table->string('rpt_tahun_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpts');
    }
};
