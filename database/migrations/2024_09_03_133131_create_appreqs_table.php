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
        Schema::create('appreqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('stat_id')->constrained();
            $table->foreignId('permitwork_id')->constrained();
            $table->string('ver_code')->unique();
            $table->timestamp('date_submitted')->nullable();
            $table->timestamp('date_disposisi')->nullable();
            $table->integer('user_disposisi')->nullable(); // nama operator
            $table->timestamp('date_processed')->nullable();
            $table->integer('user_processed')->nullable();
            $table->timestamp('date_finished')->nullable();
            $table->integer('user_finished')->nullable();
            $table->timestamp('date_rejected')->nullable();
            $table->integer('user_rejected')->nullable();
            $table->text('reason_rejected')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appreqs');
    }
};
