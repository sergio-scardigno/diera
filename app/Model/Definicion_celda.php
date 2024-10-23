<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Definicion_celda extends Model
{
    public $timestamps = false;
    protected $table = 'definicion_celda';
    // editable (true, false) - tipo_dato valores validos ('null', 'number' , 'text', 'checkbox',' radio')
    protected $fillable =	[ 'id_definicion_celda', 'id_definicion_cuadro', 'fila', 'columna', 'editable',
					          'tipo_dato', 'colspan', 'rowspan', 'titulo', 'valor_inicial', 'estilos','oferta',
          					];
	protected $primaryKey = 'id_definicion_celda'; 
    public function cuadro() {
        return $this->belongsTo('App\Model\Definicion_cuadro','id_definicion_cuadro');
    }
}
