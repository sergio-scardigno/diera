<?php

namespace App\Model\Padron;

use Illuminate\Database\Eloquent\Model;

class Localizacion_padron extends Model
{
    protected $connection = 'padron';
    public $timestamps = false;
    protected $table = 'bsas.v_localizacion_diera';
	protected $primaryKey = 'id_localizacion';
}
