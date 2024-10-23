<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Consistencia_tipo extends Model
{
    //
	public $timestamps = false;
	public $incrementing  = false;
    protected $table = 'consistencia_tipo';
    protected $fillable =	[ 
								c_consistencia_tipo,
  								descripcion,
								orden
          					];

	protected $primaryKey = 'c_consistencia_tipo';
}
