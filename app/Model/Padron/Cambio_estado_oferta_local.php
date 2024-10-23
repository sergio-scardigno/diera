<?php

namespace App\Model\Padron;

use Illuminate\Database\Eloquent\Model;

class Cambio_estado_oferta_local extends Model
{
    protected $connection = 'padron';
    public $timestamps = false;
    protected $table = 'cambio_estado_oferta_local';
	protected $primaryKey = 'id_cambio_estado_oferta_local';
}
