<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profesor', function (Blueprint $table) {
            $table->date('fecha_alta')->nullable();
            $table->decimal('salario', 10, 2)->nullable();
            $table->string('nombre', 100)->nullable()->change();
            $table->string('apellido', 130)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('profesor', function (Blueprint $table) {
            $table->dropColumn(['fecha_alta', 'salario']);
        });
    }
};
