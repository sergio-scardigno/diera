<?php

namespace App\Model\Migracion;

use Illuminate\Database\Eloquent\Model;

class Localizacion_periodo extends Model
{
    protected $table = 'migracion.localizacion_periodo';
    protected $fillable = 	[ 
								'id_localizacion_periodo',
								'id_localizacion',
								'id_serv',
								'cueanexo',
								'codigo_jurisdiccional',
								'id_periodo',
								'departamento',
								'c_departamento',
								'esc_nro',
								'nombre',
								'calle',
								'nro',
								'localidad',
								'c_localidad',
								'referencia',
								'cod_postal',
								'telefono_cod_area',
								'telefono',
								'email',
								'dependencia',
								'c_organizacion',
								'st_y',
								'st_x',
								'new_st_y',
								'new_st_x',
								'created_at',
								'updated_at'
           					];
    protected $primaryKey = 'id_localizacion_periodo';   
}
