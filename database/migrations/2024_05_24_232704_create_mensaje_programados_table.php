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
        Schema::create('mensaje_programados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo', 60);
            $table->string('descripcion', 400);
            $table->string('imagen', 300)->nullable();
            $table->string('miniatura', 300)->nullable();
            $table->string('tiempo', 5);
            $table->string('id_canal', 20);
            $table->boolean('activo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensaje_programados');
    }
};
