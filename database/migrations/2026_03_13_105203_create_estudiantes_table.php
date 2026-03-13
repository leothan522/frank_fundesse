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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colegios_id');
            // Datos Personales
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('full_name')->virtualAs("CONCAT(nombres, ' ', apellidos)")->index();
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['femenino', 'masculino']);
            $table->string('cedula')->nullable();
            $table->unsignedBigInteger('representantes_id');
            $table->boolean('direccion_representante')->default(true);
            // Ubicación Estudiante (Si es distinta al representante)
            $table->unsignedBigInteger('estado')->nullable();
            $table->unsignedBigInteger('municipio')->nullable();
            $table->unsignedBigInteger('parroquia')->nullable();
            $table->text('direccion')->nullable();
            $table->foreign('colegios_id')->references('id')->on('colegios')->cascadeOnDelete();
            $table->foreign('representantes_id')->references('id')->on('representantes')->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
