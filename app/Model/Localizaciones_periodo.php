<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Localizaciones_periodo extends Model
{
    protected $table = 'localizaciones_periodo';
    protected $primaryKey = 'id_localizacion_periodo';
	protected $fillable = [ 'id_localizacion_periodo', 'id_localizacion', 'id_serv', 'cueanexo',
    'codigo_jurisdiccional', 'id_periodo','departamento',	'c_departamento', 'esc_nro', 'nombre', 
    'calle', 'nro', 'localidad', 'c_localidad', 'referencia', 'cod_postal', 'telefono_cod_area',
    'telefono', 'email', 'dependencia', 'c_organizacion','calle_lateral_derecha','calle_lateral_izquierda','st_y','st_x' ];
     
    public function scopeName($query, $nombre){            
        if ($nombre) {
           $query-> where('localizaciones_periodo.nombre', 'ILIKE', "%" . $nombre . "%");
        }              
    }
    
    public function scopeCueanexo($query, $cueanexo){
     
      if (isset($cueanexo) and $cueanexo!="") {     
        $query-> where("localizaciones_periodo.cueanexo", "ILIKE", "%" . $cueanexo . "%");
      }         
    }
   
    public function scopeCodigo_jurisdiccional($query, $codigo_jurisdiccional){      
      if ($codigo_jurisdiccional) {
        $query-> where("localizaciones_periodo.codigo_jurisdiccional", "ILIKE", "%" . $codigo_jurisdiccional . "%");
      }         
    }
   
    public function scopeEstado_formulario($query, $estado_formulario){      
        if ($estado_formulario == 70){
            $query->where('estado_formulario_tipo.c_estado_formulario',70)
                  ->orwhere('estado_formulario_tipo.c_estado_formulario', null);
        }
        elseif ($estado_formulario != "" and $estado_formulario != "999" ) {       
            $query-> where("estado_formulario_tipo.c_estado_formulario", $estado_formulario );
        }      
        elseif ($estado_formulario == "999" ) {   
            $query-> where("estado_formulario_tipo.c_estado_formulario",'<', 80  )
                  ->orwhere('estado_formulario_tipo.c_estado_formulario', null);
           
        }      
    }

    public function scopeDepartamento($query, $distrito){     
      
        if ($distrito != "") {
            // $query-> where("localizaciones_periodo.departamento", "ILIKE", "%" . $distrito . "%");           
            $query-> where("localizaciones_periodo.c_departamento", "=", $distrito );           
        }         
    
    }   

    public function scopeRegion($query, $region_educativa){     
        if ($region_educativa != "") {            
            $query-> where("partidos.id_region_educativa", "=", $region_educativa );           
        }         
    }   


    public function scopeSupervicion($query, $supervicion){       
        if ($supervicion != "") {
            if ($supervicion=="Diegep") {                             
                $query-> where("localizaciones_periodo.codigo_jurisdiccional","like", "3%")
                ->orWhere("localizaciones_periodo.codigo_jurisdiccional","like", "4%");             
            }     
            else  {            
                $query-> where("localizaciones_periodo.codigo_jurisdiccional","like", "0%")
                ->orWhere("localizaciones_periodo.codigo_jurisdiccional","like", "2%")
                ->orWhere("localizaciones_periodo.codigo_jurisdiccional","like", "1%");
            }
        } 
    }  
     
    public function scopeRama($query, $rama){       
        if ($rama != "") {
          $query-> where("df.nombre_corto", "=", $rama);              
       }
    }

}

