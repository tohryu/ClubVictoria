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
        Schema::create('promocions', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable(); // Ej: "JUEVES & VIERNES", "CUMPLEAÑOS"
            $table->string('titulo');            // Ej: "2x1 en Tequila & Gin"
            $table->text('descripcion')->nullable(); 
            $table->string('precio_etiqueta')->nullable(); // Ej: "100% GRATIS", "DE 10 PM A 12 AM"
            $table->boolean('activo')->default(true); // Para ocultar o mostrar sin borrar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocions');
    }
};