<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class p_servicios_educativos extends Model
{
    protected $fillable = [
        'id_servicio', 'id_periodo', 'c_departamento', 'rama', 'esc_nro', 'nombre', 'calle', 'nro',
        'alta_baja', 'causa', 'fecha', 'observaciones', 'created_at', 'updated_at' 
    ];
   
}
