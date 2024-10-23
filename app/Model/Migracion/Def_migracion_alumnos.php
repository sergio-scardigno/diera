<?php

namespace App\Model\Migracion;

use Illuminate\Database\Eloquent\Model;

class Def_migracion_alumnos extends Model
{
  public $timestamps = false;
  protected $table = 'migracion.def_migracion_alumnos';
  protected $primaryKey = 'id';
  protected $fillable = 	[                
        					    'id',
								'id_definicion_celda',
								'vista',
								'campo_destino',
								
								'id_oferta_educativa',
								'id_modalidad',
								'id_terminalidad_titulo',
								'id_modo_de_dictado',
								'id_caracteristica_matricula',
								'id_anio_estudio',
								'anio_x_fila',

								'col_combo1',
								'cp_destino1',
								'col_combo2',
								'cp_destino2',
								'col_combo3',
								'cp_destino3'
          					];
}
