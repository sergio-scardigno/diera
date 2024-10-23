<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Opciones_combos extends Model
{
    protected $table = 'v_opciones_combos';
    protected $fillable =	[	'id_combo',
    							'id_definicion_formulario',
								'descripcion',								
								'orden',								
								'id_opciones_combos',
							];

	protected $primaryKey = 'id_combo';
}
