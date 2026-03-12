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
        Schema::create('colegios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->text('direccion')->nullable();
            $table->unsignedBigInteger('states_id')->nullable();
            $table->unsignedBigInteger('municipalities_id')->nullable();
            $table->unsignedBigInteger('parishes_id')->nullable();
            $table->string('google_earth')->nullable();
            $table->string('representante_nombre')->nullable();
            $table->string('representante_telefono')->nullable();
            $table->enum('representante_sexo', ['femenino', 'masculino'])->nullable();
            $table->date('fecha_fundacion')->nullable();
            $table->string('telefono_local')->nullable();
            $table->foreign('states_id')->references('id')->on('states')->nullOnDelete();
            $table->foreign('municipalities_id')->references('id')->on('municipalities')->nullOnDelete();
            $table->foreign('parishes_id')->references('id')->on('parishes')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colegios');
    }
};
