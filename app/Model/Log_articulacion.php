<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Log_articulacion extends Model
{
    protected $table = 'log_articulacion';
    protected $fillable = 	[   
								  'id_log_articulacion',
								  'inicio',
								  'fin',
								  'cant_localizaciones' ,
								  'id_usuario',
								  'created_at',
								  'updated_at',
								  'id_periodo'
								  
           					];

    protected $primaryKey = 'id_log_articulacion';   
}
