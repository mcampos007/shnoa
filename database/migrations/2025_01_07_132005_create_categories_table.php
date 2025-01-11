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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nombre del rubro
            $table->text('description')->nullable(); // Descripción opcional
            $table->string('slug')->unique(); // URL amigable
            $table->string('image')->nullable(); // Imagen del rubro
            $table->softDeletes();
            $table->foreignId('user_id')->constrained(); // Usuario que creó el rubro
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
