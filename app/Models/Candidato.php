<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = [
        'user_id',
        'vacante_id',
        'cv'
    ];
    // Accedemos a la informacion de la base de datos
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
