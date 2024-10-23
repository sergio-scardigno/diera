<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Definicion_mapacuadro extends Model
{
    public $timestamps = false;
    protected $table = 'definicion_mapacuadro';
    protected $fillable = 	[ 'id_definicion_mapacuadro', 'id_definicion_cuadro', 'c_mapa', 'c_oferta', 'descripcion'];
      protected $primaryKey = 'id_definicion_mapacuadro';      
}
