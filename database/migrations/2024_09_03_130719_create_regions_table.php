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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('id_region');
            $table->string('name_region');
            $table->string('parent_region');
            $table->string('type_region'); // Prov, Kab, Kota
            $table->string('level_region'); // Prov, Kab/Kota, Kec, Kel/Desa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
