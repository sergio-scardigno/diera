<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';
    protected $fillable = 	[ 
							  'id_log',
							  'proc', //proceso que registra el log
							  'msg',
							  'id_periodo',
							  'inicio',
							  'fin',
							  'cant_localizaciones',
							  'id_usuario',
							  'created_at',
							  'updated_at'
           					];
    protected $primaryKey = 'id_log';   
}
