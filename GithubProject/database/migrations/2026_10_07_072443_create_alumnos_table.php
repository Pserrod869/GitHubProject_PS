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
        Schema::create('alumno', function (Blueprint $table) {
            $table->id();
            // nombre
            $table->string('nombre', 100);
            // apellido
            $table->string('apellido', 130);
            // fecha nacimiento
            $table->date('fnac')->nullable();
            // genero
            $table->enum('genero', ['hombre', 'femenino', 'otro'])->nullable();
            // nota acceso
            $table->decimal('notaacceso', 4, 2)->nullable();
            $table->timestamps();
            $table->unique(['nombre', 'apellido']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
