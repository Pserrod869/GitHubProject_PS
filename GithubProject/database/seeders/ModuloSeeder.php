<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $table = "modulo";

    protected $fillable = [
        'nombre',
        'abreviatura',
        'horas',
        'creditos',
    ];
}
