<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanalesImportantes extends Model
{
    protected $fillable = [
        'id_general',
        'id_votaciones',
        'id_sugerencias',
    ];
}
