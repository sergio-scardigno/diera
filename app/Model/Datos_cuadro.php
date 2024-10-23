<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Datos_cuadro extends Model
{
    protected $table = 'datos_cuadro';
    protected $fillable = [ 'id_datos_cuadro', 'id_datos_formulario', 'id_definicion_cuadro', 'c_estado_cuadro', 'id_usuario',
							'created_at', 'updated_at'
           				];
    protected $primaryKey = 'id_datos_cuadro';   
        
	public function formulario() {
        return $this->belongsTo('App\Model\Datos_formulario','id_datos_formulario');
    }

    public function definicion_cuadro() {
        return $this->belongsTo('App\Model\Definicion_cuadro','id_definicion_cuadro');
    }

	  public function celdas()  {
        return $this->hasMany('App\Model\Datos_celda','id_datos_cuadro','id_datos_cuadro');
    }

    public function celdas_infinitas()  {
        return $this->hasMany('App\Model\Datos_celda_infinitas','id_datos_cuadro','id_datos_cuadro');
    }
    
    public function celda($fil,$col)  {
        return $this->hasMany('App\Model\Datos_celda','id_datos_cuadro','id_datos_cuadro')
              ->where('fila', $fil)
              ->where('columna', $col)
              ->first();
    }
}
