<?php

namespace App\Model\Migracion;

use Illuminate\Database\Eloquent\Model;

class Def_migracion_matricula_atendida_areas extends Model
{
    public $timestamps = false;
    protected $table = 'migracion.def_migracion_matricula_atendida_areas';
    protected $primaryKey = 'id';
    protected $fillable = 	[ 
                                  'id',
                                  'id_definicion_celda',
                                  'vista',
                                  'campo_destino',
  
                                  'id_oferta_educativa',
                                  'id_personal',
                                  'id_servicio_complementario'
                              ];	
}
