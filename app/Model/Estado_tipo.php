<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estado_tipo extends Model
{
    //
    public $timestamps = false;
    public $incrementing  = false;
    protected $table = 'estado_tipo';
    protected $fillable =	[ 
								c_estado,
								descripcion,
								orden
							];

	protected $primaryKey = 'c_estado';
}
