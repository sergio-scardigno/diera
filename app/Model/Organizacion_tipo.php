<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Organizacion_tipo extends Model
{
    //
    public $timestamps = false;
    public $incrementing  = false;
	protected $table = 'organizacion_tipo';
    protected $fillable =	[ 	c_organizacion,
								descripcion,
								posee_matricula,
          					];

	protected $primaryKey = 'c_organizacion';
}
