<?php

namespace App\Model\Migracion;

use Illuminate\Database\Eloquent\Model;

class Def_migracion_servicio extends Model
{
    public $timestamps = false;
    protected $table ='migracion.def_migracion_servicio';  
    protected $fillable = 	[  
                                  'id',
                                  'id_definicion_celda',
                                  'vista',
                                  'campo_destino',
  
                                  'id_servicio_complementario',
                                  'col_combo1',
                                  'cp_destino1'
                              ];	
      protected $primaryKey ='id';
}
