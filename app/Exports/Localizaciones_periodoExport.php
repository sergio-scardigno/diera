<?php

namespace App\Exports;

use App\Model\Localizaciones_periodo;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;


use Auth;
use User;

use DB;

class Localizaciones_periodoExport implements FromQuery, WithHeadings
{
    private $distrito, $periodo, $estado, $codigo_jurisdiccional, $cueanexo, $nombre, $rama, $supervicion, $region_educativa;
  
    public function __construct($r, $periodo) {
        $this->distrito=$r->get('distrito');        
        $this->periodo=$periodo;
        $this->nombre=$r->get('nombre');
        $this->cueanexo=$r->get('cueanexo');
        $this->codigo_jurisdiccional=$r->get('codigo_jurisdiccional');
        $this->estado= $r->estado;
        $this->rama=$r->get('rama');
        $this->region_educativa=$r->get('region_educativa');
        $this->supervicion=$r->get('supervicion');   
           
    }

    use Exportable;
    
    public function headings(): array
    {
        return [
            'CUE-ANEXO',
            'Código Jurisdiccional',
            'Nombre',
            'Distrito',
            'Región',
            'Nivel Educativo',
            'Estado del formulario'
        ];
    }
    public function title(): string
    {
        return 'Localizaciones';
    }
    
    public function query()   {
        
      $periodo2=$this->periodo;
  
    if (Auth::user()->hasRole('admin') or (Auth::user()->hasRole('supervisor') or Auth::user()->hasRole('editor') or
         Auth::user()->hasRole('solo_lectura'))) {    
             
        return Localizaciones_periodo::query()                   
            ->join ('def_formulario_organizacion as dfo', 'dfo.c_organizacion','=','localizaciones_periodo.c_organizacion')      
            ->join ('definicion_formulario as df', function ($Join) use ($periodo2)
                    { $Join->on ('df.id_definicion_formulario','=','dfo.id_definicion_formulario')->whereRaw ('"df"."id_periodo" = '. $periodo2); } )
            ->leftjoin('datos_formulario','datos_formulario.id_localizacion_periodo','=', 'localizaciones_periodo.id_localizacion_periodo')
            ->leftjoin('estado_formulario_tipo', 'estado_formulario_tipo.c_estado_formulario','=','datos_formulario.c_estado_formulario')
            ->leftjoin('partidos', 'partidos.c_departamento','=','localizaciones_periodo.c_departamento')    
            ->select(  // 'localizaciones_periodo.id_localizacion_periodo', 'localizaciones_periodo.id_localizacion',
                    'localizaciones_periodo.cueanexo', 'localizaciones_periodo.codigo_jurisdiccional' //, 'localizaciones_periodo.id_serv'
                    ,'localizaciones_periodo.nombre','localizaciones_periodo.departamento', 'id_region_educativa'
                    ,'df.nombre_corto' // , 'datos_formulario.c_estado_formulario',  
                    , DB::raw ( "case when datos_formulario.c_estado_formulario is null then 'Vacio' else estado_formulario_tipo.descripcion end as descripcion"))
            ->where ('localizaciones_periodo.id_periodo','=', $periodo2)
            ->orderBy('localizaciones_periodo.codigo_jurisdiccional', 'asc')
            ->Supervicion($this->supervicion)
            ->Name($this->nombre)
            ->Cueanexo( $this->cueanexo)
            ->Codigo_jurisdiccional( $this->codigo_jurisdiccional)
            ->Estado_formulario( $this->estado)
            ->Departamento( $this->distrito)
            ->Region($this->region_educativa)
            ->Rama($this->rama);

        }
        else {       
            $id_usuario=Auth::user()->id;   
            return Localizaciones_periodo::query()            
                ->join ('def_formulario_organizacion as dfo', 'dfo.c_organizacion','=','localizaciones_periodo.c_organizacion')      
                ->join ('definicion_formulario as df', function ($Join) use ($periodo2)
                        { $Join->on ('df.id_definicion_formulario','=','dfo.id_definicion_formulario')->whereRaw ('"df"."id_periodo" = '. $periodo2); } )
                ->join('usuario_localizacion_assn as assn', function ($Join) use ($id_usuario)
                    { $Join->on ('assn.id_localizacion','=','localizaciones_periodo.id_localizacion')->whereRaw ('"assn"."id_usuario" = '.$id_usuario); } )
                ->leftjoin('datos_formulario','datos_formulario.id_localizacion_periodo','=','localizaciones_periodo.id_localizacion_periodo')
                ->leftjoin('estado_formulario_tipo', 'estado_formulario_tipo.c_estado_formulario','=','datos_formulario.c_estado_formulario')
                ->leftjoin('partidos', 'partidos.c_departamento','=','localizaciones_periodo.c_departamento')
                ->select(   // 'localizaciones_periodo.id_localizacion_periodo', 'localizaciones_periodo.id_localizacion',
                            'localizaciones_periodo.cueanexo', 'localizaciones_periodo.codigo_jurisdiccional' //, 'localizaciones_periodo.id_serv'
                            ,'localizaciones_periodo.nombre','localizaciones_periodo.departamento', 'id_region_educativa'
                            ,'df.nombre_corto' // , 'datos_formulario.c_estado_formulario',  
                            , DB::raw ( "case when datos_formulario.c_estado_formulario is null then 'Vacio' else estado_formulario_tipo.descripcion end as descripcion"))
                ->where ('localizaciones_periodo.id_periodo','=', $periodo2)
                ->orderBy('localizaciones_periodo.codigo_jurisdiccional', 'asc')
                ->Supervicion($this->supervicion)
                ->Name($this->nombre)
                ->Cueanexo( $this->cueanexo)        
                ->Codigo_jurisdiccional( $this->codigo_jurisdiccional)
                ->Estado_formulario( $this->estado)
                ->Departamento( $this->distrito)
                ->Region($this->region_educativa)
                ->Rama($this->rama);

        }
    }
}
