<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profesor', function (Blueprint $table) {
            $table->string('nombre', 100);
            $table->string('apellido', 130);
            $table->date('fnac')->nullable();
            $table->enum('genero', ['hombre', 'femenino', 'otro'])->nullable();
            $table->string('especialidad', 150);
        });
    }

    public function down(): void
    {
        Schema::table('profesor', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'apellido', 'fnac', 'genero', 'especialidad']);
        });
    }
};
