<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajeProgramado extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'miniatura',
        'tiempo',
        'id_canal',
        'activo',
    ];
}
