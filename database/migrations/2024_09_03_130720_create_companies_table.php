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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('commodity_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->string('name_company');
            $table->string('province_company', 20);
            $table->string('kab_kota_company', 20);
            $table->string('kecamatan_company', 20)->nullable();
            $table->string('kel_desa_company', 20)->nullable(); // kelurahan atau desa
            $table->text('address_sk_company');
            $table->text('notes_company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
