<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('libros', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('titulo');
        $table->string('autor')->nullable();
        $table->foreignId('formato_id')->nullable()->constrained()->onDelete('set null');
        $table->foreignId('estado_id')->nullable()->constrained()->onDelete('set null');
        $table->string('idioma')->nullable();
        $table->integer('numero_paginas')->nullable();
        $table->integer('pagina_actual')->nullable();
        $table->string('valoracion')->nullable();
        $table->text('comentario')->nullable();
        $table->date('fecha_lectura')->nullable();
        $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
