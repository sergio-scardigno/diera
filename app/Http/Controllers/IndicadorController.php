<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($indicador)   {   
        // $indicador='7.4';
        $dominio ='P';
        $oferta = 456;
        $momento = 'C';

        // -- 7.4 cANTIDAD DE UNIDADES DE SERVICIO       // -- SERIE HISTORICA POR SECTOR
         $sql = DB::connection('indicadores')->Select("select i.indicador, ti.detalle, ti.descripcion,ip.descripcion_periodo,
             sum ( case when  i.dependencia=6 then i.valor:: integer else 0 end) as sector_estatal,
             sum ( case when  i.dependencia=5 then i.valor:: integer else 0 end) as sector_privado,
             sum ( case when  i.dependencia=9 then i.valor:: integer else 0 end) as total
             FROM indicadores i
                 inner join ts_periodos ip on ip.id_periodo=i.idPeriodo
                 inner join ts_cod_indicadores ti on ti.indicador=i.indicador
                 inner join ts_cod_dependencia td on td.cod_depend=i.dependencia
             where i.indicador='".$indicador."' and dominio='".$dominio."' and oferta = ".$oferta."  and momento='".$momento."'
                 group by i.indicador,ti.detalle,ti.descripcion,ip.descripcion_periodo, i.idperiodo
                 order by i.idperiodo");   

        return json_encode( $sql);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
