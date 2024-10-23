<?php

namespace App\Model\Padron;

use Illuminate\Database\Eloquent\Model;

class Oferta_local extends Model
{
    protected $connection = 'padron';
    public $timestamps = false;
    protected $table = 'oferta_local';
	protected $primaryKey = 'id_oferta_local';
}
