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
        Schema::create('medicine_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_type_id')->reference('id')->on('medicine_types');
            $table->string('content');
            $table->foreignId('medicine_id')->reference('id')->on('medicines');
            $table->foreignId('language_id')->reference('id')->on('languages')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_details');
    }
};
