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
            $table->string('region_id', 30)->references('id')->on('regions');
            $table->string('name_company');
            $table->string('province_company');
            $table->string('kab_kota_company');
            $table->string('kecamatan_company')->nullable();
            $table->text('kel_desa_company')->nullable(); // kelurahan atau desa
            $table->text('address_sk_company')->nullable();
            $table->string('number_sk_company')->nullable();
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
