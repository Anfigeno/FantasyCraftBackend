<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesDeAdministracion extends Model
{
    protected $fillable = [
        'id_administrador',
        'id_staff',
    ];
}
