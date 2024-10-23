<?php

namespace App\Model\Padron;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $connection = 'padron';
    public $timestamps = false;
    protected $table = 'movimiento';
	protected $primaryKey = 'id_movimiento';
}
