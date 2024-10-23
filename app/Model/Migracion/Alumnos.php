<?php

namespace App\Model\Migracion;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    protected $table = 'migracion.alumnos';
    protected $fillable = 	[ 
								'id_alumnos',
								'id_localizacion_periodo',
								'id_oferta_educativa',
								'id_anio_estudio',
								'id_caracteristica_matricula',
								'id_modalidad',
								'id_terminalidad_titulo',
								'cantidad_total',
								'cantidad_varones',
								'cantidad_mujeres',
								'id_modo_de_dictado',
								'pid_serv_dest'
           					];
    protected $primaryKey = 'id_alumnos';   
}
