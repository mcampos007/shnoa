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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); // Relación con rubros
            $table->string('name')->unique(); // Nombre del producto
            $table->text('description')->nullable(); // Descripción opcional
            $table->integer('stock')->default(0); // Stock actual
            $table->decimal('price', 10, 2); // Precio de venta final
            $table->boolean('is_active')->default(true); // Campo para desactivar el producto
            $table->boolean('is_in_carousel')->default(false); // Indicar si está en el carrusel
            $table->string('slug')->unique(); // URL amigable
            $table->softDeletes();
            $table->foreignId('user_id')->constrained(); // Usuario que creó el producto
            $table->foreignId('created_by')->constrained('users'); // Usuario que creó el producto
            $table->foreignId('updated_by')->nullable()->constrained('users'); // Usuario que actualizó el producto
            $table->foreignId('deleted_by')->nullable()->constrained('users'); // Usuario que eliminó el producto

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
