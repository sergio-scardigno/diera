<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Definicion_cuadro extends Model
{
    protected $table = 'definicion_cuadro';
    protected $fillable = 	[ 'id_definicion_cuadro', 'id_definicion_formulario', 'nombre', 'numero', 'descripcion',
                               'c_tipo_cuadro', 'c_criterio_completitud', 'fecha_modificacion', 'created_at', 'update_at',
                               'ancho', 'encabezado', 'indicaciones', 'ayuda'
          					];

    protected $primaryKey = 'id_definicion_cuadro';     
    public function formulario() {
        return $this->belongsTo('App\Model\Definicion_formulario','id_definicion_formulario');
    }      

	public function celdas()    {
        return $this->hasMany('App\Model\Definicion_celda','id_definicion_cuadro','id_definicion_cuadro');
    }
    
    public function celda($fil,$col)   {
        return $this->hasMany('App\Model\Definicion_celda','id_definicion_cuadro','id_definicion_cuadro')
              ->where('fila', $fil)
              ->where('columna', $col)
              ->first();
    }
}
