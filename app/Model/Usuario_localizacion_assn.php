<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Usuario_localizacion_assn extends Model
{
    protected $table = 'usuario_localizacion_assn';
    protected $primaryKey = 'id';
    protected $fillable = [
                             'id_localizacion',
                             'id_usuario',

                          ];
}
