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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete(); // Relación con productos
            $table->string('image_path'); // Ruta de la imagen
            $table->boolean('is_featured')->default(false); // Indicar si es la imagen destacada
            $table->softDeletes();
            $table->foreignId('created_by')->constrained('users'); // Usuario que creó la imagen
            $table->foreignId('updated_by')->nullable()->constrained('users'); // Usuario que actualizó la imagen
            $table->foreignId('deleted_by')->nullable()->constrained('users'); // Usuario que eliminó la imagen
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
