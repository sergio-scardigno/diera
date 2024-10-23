<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Definicion_consistencia extends Model
{
    public $timestamps = false;
    protected $table = 'definicion_consistencia';
    protected $fillable =	[ 	'id_consistencia', 'id_definicion_formulario', 'id_definicion_cuadro', 'id_definicion_celda',
								'c_tipo_consistencia', 'c_categoria_consistencia', 'c_estado', 'numero', 'cmp1', 'cmp2', 'cmp3',
								'msg1', 'msg2', 'msg3', 'descripcion',
          					];
	protected $primaryKey = 'id_consistencia';

	public function definicion_formulario(){
        return $this->belongsTo('App\Model\Definicion_formulario','id_definicion_formulario');
    }
    public function definicion_cuadro() {
        return $this->belongsTo('App\Model\Definicion_cuadro','id_definicion_cuadro');
    }
    public function definicion_celda() {
        return $this->belongsTo('App\Model\Definicion_celda','id_definicion_celda');
    }
    public function tipo_consistencia() {
        return $this->belongsTo('App\Model\Consistencia_tipo','c_tipo_consistencia');
    }
    public function categoria_consistencia() {
        return $this->belongsTo('App\Model\categoria_consistencia_tipo','c_categoria_consistencia');
    }
    public function estado() {
        return $this->belongsTo('App\Model\Estado_tipo','c_estado');
    }    
}
