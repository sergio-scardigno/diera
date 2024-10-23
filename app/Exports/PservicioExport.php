<?php

namespace App\Exports;

use App\Model\p_servicios_educativos;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use DB;
class PservicioExport implements FromQuery, WithHeadings
{ 
    private $periodo, $nronota, $establecimiento ;
    
    public function __construct($r, $periodo) {        
        $this->periodo=$periodo;
        $this->nronota=$r->get('nronota2');
        $this->establecimiento=$r->get('establecimiento_servicio');        
    }



    use Exportable;

  public function headings(): array
    {
        return [           
            'Distrito',            
            'Rama de enseñanza',
            'Número de Establecimiento',
            'Establecimiento',
            'Calle',
            'Nro',
            'Movimiento',
           'Motivo',
           'Fecha',
           'Observaciones',
           'Planilla enviada por',
           'Nombre de usuario',
           'Número de nota'
        ];
    }
    public function title(): string
    {
        return 'PLANILLA DE ALTAS, BAJAS Y NOVEDADES DE SERVICIOS EDUCATIVOS';
    }

    
    public function query()   { 
        
     return p_servicios_educativos::query() 
        ->select('partidos.nombre as distrito', 'p_servicios_educativos.rama', 'p_servicios_educativos.esc_nro',
        'p_servicios_educativos.nombre', 'p_servicios_educativos.calle', 'p_servicios_educativos.nro', 'p_servicios_educativos.alta_baja',
        'p_servicios_educativos.causa', 'p_servicios_educativos.fecha', 'p_servicios_educativos.observaciones', 
         'users.name', 'users.username', 'p_servicios_educativos.nronota')
        ->join('partidos', 'p_servicios_educativos.c_departamento', '=', 'partidos.c_departamento')      
        ->join('users', 'users.id', '=', 'p_servicios_educativos.id_usuario')
        ->Nronota($this->nronota)   
        // ->Establecimiento($this->establecimiento)   
        ->where('id_periodo', '=', $this->periodo);
    }
}
