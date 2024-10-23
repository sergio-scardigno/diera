<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Combo_tipo extends Model
{
    //
	protected $table = 'combo_tipo';
    protected $fillable =	[ 
							    id_combo,
								descripcion								
							];

	protected $primaryKey = 'id_combo';


}
