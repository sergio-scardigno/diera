<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    protected $table = 'localizaciones'; 
    protected $primaryKey='id_localizacion';
    protected $fillable = [
        'id_localizacion','id_serv', 'cueanexo', 'codigo_jurisdiccional', 'departamento',
        'c_departamento', 'esc_nro', 'nombre', 'calle', 'nro', 'localidad', 'c_localidad',
        'referencia', 'cod_postal', 'telefono_cod_area', 'telefono', 'email', 'dependencia', 'c_organizacion'
    ];   
}
