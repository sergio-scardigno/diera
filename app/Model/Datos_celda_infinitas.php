<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Datos_celda_infinitas extends Model
{
    public $timestamps = false;
    protected $table = 'datos_celda_infinitas';
    protected $fillable =	[ 'id_datos_celda', 'id_definicion_celda', 'id_datos_cuadro', 'fila', 'valor', 'updated_at'
          					];

	protected $primaryKey = 'id_datos_celda';
 
    public function definicion_celda() {
        return $this->belongsTo('App\Model\Definicion_celda','id_definicion_celda');
    }
    
    public function cuadro() {
        return $this->belongsTo('App\Model\Datos_cuadro','id_datos_cuadro');
    }
    
}
