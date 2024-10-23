<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Datos_formulario extends Model
{
    protected $table = 'datos_formulario';
    protected $fillable = [ 'id_datos_formulario', 'id_definicion_formulario', 'id_localizacion_periodo',  'c_estado_formulario',
							'fecha_inicio_carga', 'fecha_fin_carga', 'fecha_recepcion_UE', 'id_usuario_update', 'id_usuario_inicia',
                            'id_usuario_confirma', 'created_at', 'updated_at'
				          ];

    protected $primaryKey = 'id_datos_formulario';

    public function definicion_formulario()   {
        return $this->belongsTo('App\Model\Definicion_formulario','id_definicion_formulario');
    }
    public function cuadros()  {
        return $this->hasMany('App\Model\Datos_cuadro','id_datos_formulario','id_datos_formulario');
    }
    
    public function cuadro($numero) {
        return $this->hasMany('App\Model\Datos_cuadro','id_datos_formulario','id_datos_formulario')
              ->where('numero', $numero)              
              ->first();
    }
}
