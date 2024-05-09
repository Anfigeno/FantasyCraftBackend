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
        Schema::create('comando_personalizados', function (Blueprint $table) {
            $table->id();
            $table->string('palabra_clave', 50)->unique();
            $table->string('contenido', 2000);
            $table->string('autor', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comando_personalizados');
    }
};
