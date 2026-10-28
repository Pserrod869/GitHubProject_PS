<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesor';

    protected $fillable = ['nombre', 'apellido', 'fecha_alta', 'especialidad', 'salario'];

    protected function casts(): array
    {
        return [
            'fecha_alta' => 'date',
            'salario' => 'decimal:2',
        ];
    }
}
