<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categoria_consistencia_tipo extends Model
{
    //
	public $timestamps = false;
	public $incrementing  = false;
    protected $table = 'categoria_consistencia_tipo';
    protected $fillable =	[ 
								c_categoria_consistencia,
								descripcion,
								orden

							];

	protected $primaryKey = 'c_categoria_consistencia';
}
