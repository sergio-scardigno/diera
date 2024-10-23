<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estado_formulario_tipo extends Model
{
    protected $table = 'estado_formulario_tipo';
    protected $primaryKey = 'c_estado_formulario';
    protected $fillable = [ 'c_estado_formulario', 'descripcion', 'orden'];
}
