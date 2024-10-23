<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use DB;

class EstadisticaExport implements WithMultipleSheets
{
    use Exportable;
 
    private $param, $filter_user;

    public function __construct($param, $filter_user ) {
        
        // $this->data=$data;
        // $this->periodo=$periodo;
        // $this->distrito=$distrito;
        // $this->region=$region;

        $this->param=$param;
        $this->filter_user=$filter_user;
    }

    public function sheets(): array
    {
        $sheets = [];
        
        // $sheets[] = new ($this->data, $this->$periodo);
        // $periodo2=$this->periodo;
        // $sheets[] = new InvoicesPerMonthSheet($this->year, $month);

        $sheets[] = DB::select("select 'Total'::text as formulario,
        sum(1) as Total,
        sum( case when  (c_estado_formulario is null or c_estado_formulario between 70 and 79) then 1 else 0 end) as vacio,
        sum( case when (c_estado_formulario between  0 and 9 or c_estado_formulario = 110) then 1 else 0 end) as con_error_de_padron,
        sum( case when  c_estado_formulario between 10 and 29 then 1 else 0 end) as en_carga_con_error,
        sum( case when  c_estado_formulario between 30 and 69 then 1 else 0 end) as en_carga,
        sum( case when  c_estado_formulario between 80 and 99 then 1 else 0 end) as completo,
        sum( case when  c_estado_formulario = 100 then 1 else 0 end) as confirmado,0 as orden
   from localizaciones_periodo lp ".$this->filter_user."-- le agrego el filtro del usuario
        inner join def_formulario_organizacion dfo using(c_organizacion)
        inner join definicion_formulario df on df.id_definicion_formulario=dfo.id_definicion_formulario and df.id_periodo=lp.id_periodo 
        left join datos_formulario ef on ef.id_localizacion_periodo=lp.id_localizacion_periodo
   where lp.id_periodo=:idperiodo
   
   union
      (select  nombre_corto,
              sum(1) as Total,
              sum( case when  (c_estado_formulario is null or c_estado_formulario between 70 and 79) then 1 else 0 end) as vacio,
              sum( case when (c_estado_formulario between  0 and 9 or c_estado_formulario = 110) then 1 else 0 end) as con_error_de_padron,
              sum( case when  c_estado_formulario between 10 and 29 then 1 else 0 end) as en_carga_con_error,
              sum( case when  c_estado_formulario between 30 and 69 then 1 else 0 end) as en_carga,
              sum( case when  c_estado_formulario between 80 and 99 then 1 else 0 end) as completo,
              sum( case when  c_estado_formulario = 100 then 1 else 0 end) as confirmado, row_number() over (order by nombre_corto) orden
         from localizaciones_periodo lp ".$this->filter_user."--le agrego el filtro del usuario
              inner join def_formulario_organizacion dfo using(c_organizacion)
              inner join definicion_formulario df on df.id_definicion_formulario=dfo.id_definicion_formulario and df.id_periodo=lp.id_periodo 
              left join datos_formulario ef on ef.id_localizacion_periodo=lp.id_localizacion_periodo
         where lp.id_periodo=:idperiodo 
         group by nombre_corto order by nombre_corto
        )
   order by orden", $this->param, 1 );
        

        return $sheets;
    }

}


  //       $excel->sheet('Estado de carga', function($sheet)  use ($data, $periodo){
        //           $sheet->loadView('estadisticaexcel', compact(array('data'), array('periodo')));                 
        //       });

        //       $excel->sheet('Totales x Distrito', function($sheet)  use ($periodo, $distrito){
        //           $sheet->loadView('formularioexceldistrito', compact( array('periodo'), array('distrito')));                 
        //       });   
        //      $excel->sheet('Totales x Región', function($sheet)  use ($periodo, $region){
        //           $sheet->loadView('formularioexcelregion', compact( array('periodo'), array('region')));                 
        //       });   
