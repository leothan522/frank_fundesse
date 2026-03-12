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
        Schema::create('deportes_modalidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deportes_id');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->unsignedTinyInteger('edad_minima');
            $table->unsignedTinyInteger('edad_maxima');
            $table->enum('genero', ['femenino', 'masculino', 'mixto']);
            $table->enum('tipo_participacion', ['individual', 'colectivo']);
            $table->unsignedTinyInteger('min_participantes')->default(1);
            $table->unsignedTinyInteger('max_participantes')->default(1);
            $table->boolean('is_active')->default(true);
            $table->foreign('deportes_id')->references('id')->on('deportes')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deportes_modalidades');
    }
};
