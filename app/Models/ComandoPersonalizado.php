<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandoPersonalizado extends Model
{
    protected $fillable = [
        'palabra_clave',
        'contenido',
        'autor',
    ];
}
