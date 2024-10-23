<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class p_servicios_educativos extends Model
{
    protected $table = 'p_servicios_educativos';
    protected $primaryKey = 'id';
    protected $fillable = [ 'id', 'id_periodo', 'c_departamento', 'rama', 'esc_nro', 'nombre', 'calle', 'nro', 'alta_baja',
    'causa', 'fecha', 'observaciones', 'id_usuario', 'nronota', 'create_at', 'update_at'
    ];
     
      public function scopeNronota($query, $nronota2){    
        if ($nronota2 >= 0 and $nronota2!='') {
        $query-> where('nronota',  $nronota2); 
       }
      }

    public function scopeDistrito($query, $distrito){            
        if ($distrito) {
          $query-> where("partidos.c_departamento", "=", $distrito );           
        }              
    }

}
