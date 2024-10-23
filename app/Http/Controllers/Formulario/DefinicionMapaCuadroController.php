<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Datos_cuadro;
use App\Model\Datos_celda;
use App\Model\Definicion_mapacuadro;

class DefinicionMapaCuadroController extends Controller
{

    /**
     * devuelve las consistencias de un cuadro
     *
     * @return objeto creado
     */
    static public function mapa ($id_definicion_cuadro, $id_localizacion_periodo) 
    {
        $mapa =Definicion_mapacuadro::select('c_mapa')
                ->join ('oferta_periodo','oferta_periodo.c_oferta','definicion_mapacuadro.c_oferta')
                ->where('id_definicion_cuadro', $id_definicion_cuadro)
                ->where('oferta_periodo.id_localizacion_periodo', $id_localizacion_periodo)
                ->where('oferta_periodo.c_estado', 1) // Activo
                ->groupBy('c_mapa')
                ->get();

        $mapa= $mapa->map(function ($item, $key)
                                { return $item->c_mapa;
                                })->toArray();
    //    dd($mapa) ;
        return (is_null($mapa) ? [] : $mapa);
         

    }  

    /**
     * agregar un c_mapa en la tabla con sus lista de ofertas y eliminar anteriores que no estan mas
     *
     * @return \Illuminate\Http\Response
     */
    static public function mapacuadro_store_c_mapa($id_definicion_cuadro,$c_mapa,$ofertas=[],$descripcion)
    {   
        // eliminar ofertas y c_mapa viejos que no estan en el array $ofertas enviado        
        $DOfertas= Definicion_mapacuadro::select('c_oferta')
                    ->where('id_definicion_cuadro', $id_definicion_cuadro)
                    ->where('c_mapa', $c_mapa)
                    ->get();
        foreach ($DOfertas as $DO) 
            {
                if (!in_array($DO->c_oferta, $ofertas))
                {
                    Definicion_mapacuadro::where('id_definicion_cuadro', $id_definicion_cuadro)
                    ->where('c_mapa', $c_mapa)
                    ->delete();
                }
            }


        // agregar ofertas que puedan faltar en la base
        foreach ($ofertas as $key => $oferta)
        {
            $id = Definicion_mapacuadro::UpdateOrCreate( 
                        [  'id_definicion_cuadro' => $id_definicion_cuadro,
                           'c_mapa' => $c_mapa,
                           'c_oferta' => $oferta
                        ],
                        [ 'descripcion'=>$descripcion] );

        }
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

}
