<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class localidad_tipo extends Model
{
    protected $table = 'localidad_tipo';
    protected $primaryKey = 'c_localidad';
    protected $fillable = [ 'c_localidad', 'c_departamento', 'nombre' ];

    public function scopeDepartamento($query, $c_departamento){
        if ($c_departamento) {            
            $query->where('c_departamento',$c_departamento);
        }         
    }
}
