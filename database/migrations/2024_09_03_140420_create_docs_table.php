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
        Schema::create('docs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('appreq_id')->constrained();
            $table->string('name_doc');
            $table->string('type_doc');
            // $table->enum('type_doc', ['Ajuan Awal', 'Revisi', 'by Operator', 'by Evaluator']);
            $table->text('desc_doc')->nullable();
            $table->boolean('sender')->default(0); // 0 untuk pemohon // 1 untuk operator
            $table->boolean('viewed')->default(0);
            $table->string('file_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docs');
    }
};
