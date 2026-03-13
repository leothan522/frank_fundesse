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
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('nombre');
            $table->enum('sexo', ['femenino', 'masculino']);
            $table->string('telefono');
            $table->string('telefono_2')->nullable();
            $table->unsignedBigInteger('estado')->nullable();
            $table->unsignedBigInteger('municipio')->nullable();
            $table->unsignedBigInteger('parroquia')->nullable();
            $table->text('direccion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representantes');
    }
};
