<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Oferta_periodo extends Model
{
    public $timestamps = false;
    public $incrementing  = false;
    protected $table = 'oferta_periodo';
    protected $fillable =	[ 'id_oferta_periodo', 'id_localizacion_periodo', 'id_oferta_local', //-- columna de oferta_local de padron
								'c_oferta', 'c_estado', 'fecha_actualizacion', 'fecha_vigencia'
							];
	protected $primaryKey = 'id_oferta_periodo';
}
