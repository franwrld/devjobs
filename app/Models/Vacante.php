<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    protected $casts = [
        'ultimo_dia' => 'date'
    ];

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];
    // Para pasar el nombre de la categoria y salario a la vista y no el ID para mostrar Vacante
    // $variable -> tabla en BD -> nombre de la columna
    // $vacante->categoria->categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }
}
