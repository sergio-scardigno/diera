<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Definicion_formulario extends Model
{
    protected $table = 'definicion_formulario';
    protected $fillable = [ 'id_definicion_formulario',  'nombre', 'nombre_corto', 'descripcion', 'id_periodo', 
                            'color', 'created_at', 'update_at'
                          ];
    protected $primaryKey = 'id_definicion_formulario';

    public function cuadros() {
        return $this->hasMany('App\Model\Definicion_cuadro','id_definicion_formulario','id_definicion_formulario')->orderBy('numero');
    }
    
    public function organizaciones() {
        return $this->hasMany('App\Model\Def_formulario_organizacion','id_definicion_formulario','id_definicion_formulario');
    }
    
    public function cuadro($numero) {
        return $this->hasMany('App\Model\Definicion_cuadro','id_definicion_formulario','id_definicion_formulario')
              ->where('numero', $numero)              
              ->first();
    }
}
