<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Datos_localizacion_periodo extends Model
{
    protected $table = 'datos_localizacion_periodo';
    protected $fillable = [ 'id_localizacion_periodo', 'id_localizacion', 'id_serv', 'cueanexo', 'codigo_jurisdiccional',
							'id_periodo', 'departamento', 'c_departamento', 'esc_nro', 'nombre', 'calle', 'nro', 'localidad',
							'c_localidad', 'referencia', 'cod_postal', 'telefono_cod_area', 'telefono', 'email', 'email2', 'dependencia',
							'c_organizacion', 'st_y', 'st_x', 'new_st_y', 'new_st_x', 
    						'calle_lateral_derecha', 'calle_lateral_izquierda', 'responsable', 'email_resp'
				          ];
    protected $primaryKey = 'id_localizacion_periodo';
}
