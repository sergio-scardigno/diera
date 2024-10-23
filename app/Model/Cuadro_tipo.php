<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cuadro_tipo extends Model
{
    //
	public $timestamps = false;
	public $incrementing  = false;

    protected $table = 'cuadro_tipo';
    protected $fillable =	[ 
							    c_cuadro_tipo,
								descripcion,
								orden
							];

	protected $primaryKey = 'c_cuadro_tipo';

}
