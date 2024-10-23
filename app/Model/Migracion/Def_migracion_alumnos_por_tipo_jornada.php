<?php

namespace App\Model\Migracion;

use Illuminate\Database\Eloquent\Model;

class Def_migracion_alumnos_por_tipo_jornada extends Model
{
    public $timestamps = false;
    protected $table = 'migracion.def_migracion_alumnos_por_tipo_jornada';
    protected $primaryKey = 'id';
    protected $fillable = 	[  
                                  'id',
                                  'id_definicion_celda',
                                  'vista',
                                  'campo_destino',
  
                                  'id_oferta_educativa',
                                  'id_tipo_jornada',
                                  'col_combo1',
                                  'cp_destino1'
                              ];	
}
