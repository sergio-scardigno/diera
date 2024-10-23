<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Def_formulario_organizacion extends Model
{
    protected $table = 'def_formulario_organizacion';
    protected $fillable =	[ 
								'id_def_formulario_organizacion',
								'id_definicion_formulario',
								'c_organizacion'
          					];

	protected $primaryKey = 'id_def_formulario_organizacion';
    public $timestamps = false;
 
    public function definicion_formulario()
    {
        return $this->belongsTo('App\Model\Definicion_formulario','id_definicion_formulario');
    }
    
    public function organizacion_tipo()
    {
        return $this->belongsTo('App\Model\Organizacion_tipo','c_organizacion');
    }
}
