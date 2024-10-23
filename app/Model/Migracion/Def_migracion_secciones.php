<?php

namespace App\Model\Migracion;

use Illuminate\Database\Eloquent\Model;

class Def_migracion_secciones extends Model
{
    public $timestamps = false;
    protected $table = 'migracion.def_migracion_secciones';
    protected $primaryKey = 'id';
    protected $fillable = 	[                
                                  'id',
                                  'id_definicion_celda',
                                  'vista',
                                  'campo_destino',
                                  
                                  'id_oferta_educativa',
                                  'id_tipo_seccion',
                                  'id_anio_estudio',
  
  
                                  'col_combo1',
                                  'cp_destino1',
                                  'col_combo2',
                                  'cp_destino2',
                                  'col_combo3',
                                  'cp_destino3'
                                ];
}
